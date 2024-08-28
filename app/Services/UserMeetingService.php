<?php
namespace App\Services;

use App\Models\AllRecording;
use App\Services\BaseModelService;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\IsMeetingRunningParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Picqer\BolRetailerV10\Model\ReducedTransport;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\User\UserMeeting;
use App\Models\User\UserMeetingRoom;
use App\Transformers\Admin\RecordingTransformer;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;
use Yajra\DataTables\Contracts\DataTable;
use Spatie\GoogleCalendar\Event;


class UserMeetingService extends BaseModelService
{
    protected $user_recordings_key;
    public function __construct()
    {
        parent::__construct(new UserMeeting());
        $this->allow_all_records = true;
    }



    // create model
    public function create(Request $request)
    {
        try {
            $data = $this->getModelAttributes($request);
            DB::beginTransaction();
            $meeting  = $this->model::create($data);
            $this->createBigBlueButtonMeeting($data , $meeting);
            DB::commit();
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }



    public function createQuickMeeting(Request $request)
    {
        try{
            $room = UserMeetingRoom::query()->find($request->room);
            $data = [
                'name' => $request->name,
                'meeting_id' => generateMeetingId(10),
                'welcome_message' => 'Welcome To '.$request->name,
                'user_id' => getAuthUser('web')->id,
                'room_id' => $room->id,
                'max_participants' => $room->max_participants,
            ];
            DB::beginTransaction();
            $meeting = $this->model->create($data);
            $this->createBigBlueButtonMeeting($data , $meeting);
            DB::commit();
            return generateResponse(status:true , extra_data:['function_to_call'=>'openMeetingModal' , 'function_params' => route('site.user.join_public_meeting' , $meeting->meeting_id)]);
        }catch(Throwable $e)
        {
            DB::rollBack();
            Log::error("Fail with create quick meeting participants: " . $e->getMessage());
            return generateResponse(status:false,message:__('response.faild_created'));
        }
    }


    /**
     * Create Meeting On BigBlBueutton
     */
    protected function createBigBlueButtonMeeting(array $data , UserMeeting $meeting) : void
    {
        $bbb = new BigBlueButton();
        $bbb->setTimeOut(180);
        $meeting_params = new CreateMeetingParameters($meeting->meeting_id , $data['name']);
        $meeting_params->setWelcomeMessage($data['welcome_message']);
        $meeting_params->setBannerText($data['welcome_message']);
        $meeting_params->setBannerColor('#000000');
        $meeting_params->setLogoutUrl(route('site.user.join_public_meeting' , $meeting->meeting_id));
        $meeting_params->setFreeJoin(true);
        $meeting_params->setLogo(asset('assets/common/logo.png'));
        $meeting_params->setCopyright(config('app.name'));
        if(isset($data['max_participants']))
        {
            $meeting_params->setMaxParticipants($data['max_participants']);
        }
        $meeting_params->setRecord(true);
        $meeting_params->setAllowStartStopRecording(true);
        $meeting_params->setAutoStartRecording(false);
        $response = $bbb->createMeeting($meeting_params);
        if ($response->getReturnCode() == 'FAILED') {
            throw new Exception('Can\'t create room! please contact our administrator.');
        }

        $meeting_meta_data = get_object_vars($response->getRawXml());
        $meeting->meta_data = json_encode($meeting_meta_data);
        $meeting->recored_id = $meeting_meta_data['internalMeetingID'];
        $meeting->save();
    }


    /**
     * Activate The meeting by recreating it if it's no longer exists and has been forcibly ended
     */
    public function activate($meeting)
    {
        ini_set('max_execution_time', 500);
        $bbb = new BigBlueButton();
        $bbb->setTimeOut(180);

        if (!$this->isMeetingExistsAndRuninng($meeting, $bbb)) {
            $this->createBigBlueButtonMeeting($meeting->toArray() , $meeting);
        }
        return true;
    }

    /**
     * Check if the meeting exists and is has not been forcibly ended
     */
    protected function isMeetingExistsAndRuninng($meeting, BigBlueButton $bbb): bool
    {
        if (Cache::has('is_meeting_exists_' . $meeting->id)) {
            return Cache::get('is_meeting_exists_' . $meeting->id);
        }
        $get_meeting_info_params = new GetMeetingInfoParameters($meeting->meeting_id);
        $response = $bbb->getMeetingInfo($get_meeting_info_params);
        return Cache::remember('is_meeting_exists_' . $meeting->id, now()->addMinutes(5), fn() => $response->getReturnCode() == 'SUCCESS' && !$response->getMeeting()->hasBeenForciblyEnded());
    }





    public function toggleStatus($id)
    {
        try {
            $model = $this->find($id);
            $model->update([
                'status' => !$model->status,
            ]);
            $response = generateResponse(status: true, message: __('response.success_updated'));
        } catch (Throwable $e) {
            Log::error("Fail with " . __FUNCTION__ . " in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            $response = generateResponse(status: false, message: __('response.error'));
        }
        return $response;
    }



    protected function getModelAttributes($request): array
    {
        $data = $request->toArray();
        $data['meeting_id'] = generateMeetingId(10);
        $data['is_scheduled'] = @$data['is_scheduled'] == 'on';
        $data['user_id'] = getAuthUser('web')->id;
        return $data;
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query()->whereIn('room_id' , getAuthUser('web')->rooms()->pluck('room_id')->toArray())->with(['user' , 'room']);
        return DataTables::of($query)
            ->setTransformer($this->model->transformer)
            ->make(true);
    }

    /**
     * fetching bbb recordings for the current auth user.
     * @param mixed $meeting
     * @return void
     */
    public function getRecordings(): array
    {
        $db_records = $this->model->pluck('meeting_id')->toArray();
        $bbb = new BigBlueButton();
        $recordings_params = new GetRecordingsParameters();
        $recordings = $bbb->getRecordings($recordings_params);
        $recordings_list = [];
        if ($recordings->getReturnCode() == 'SUCCESS') {
            foreach ($recordings->getRecords() as $record) {
                if (in_array($record->getMeetingId(), $db_records)) {
                    $class_record = new \stdClass;
                    $class_record->name = $record->getName();
                    $class_record->endTime = $record->getEndTime();
                    $class_record->duration = $record->getPlaybackLength();
                    $class_record->playbackUrl = $record->getPlaybackUrl();
                    $recordings_list[] = $class_record;
                }
            }
        }
        return cacheAndGet($this->user_recordings_key, now()->addHour(2), $recordings_list);
    }





    public function getTableDataForRecordings(Request $request)
    {
        $this->user_recordings_key = 'user_recordings_' . getAuthUser('web')->id;
        if (Cache::has($this->user_recordings_key)) {
            $query = Cache::get($this->user_recordings_key);
        } else {
            $query = $this->getRecordings();
        }
        return DataTables::collection($query)
            ->setTransformer(RecordingTransformer::class)
            ->make(true);
    }




}
