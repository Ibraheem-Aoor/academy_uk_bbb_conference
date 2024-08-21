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
use App\Transformers\Admin\RecordingTransformer;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use SimpleXMLElement;
use Yajra\DataTables\Contracts\DataTable;
use Spatie\GoogleCalendar\Event;


class MeetingService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new Meeting());
        $this->allow_all_records = true;
    }


    // create model
    public function create(Request $request)
    {
        try {
            $data = $this->getModelAttributes($request);
            $this->createBigBlueButtonMeeting($data);
            Meeting::create($data);
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }


    /**
     * Create Meeting On BigBlBueutton
     */
    protected function createBigBlueButtonMeeting(array $data)
    {
        $bbb = new BigBlueButton();
        $bbb->setTimeOut(180);
        $meeting_params = new CreateMeetingParameters($data['name'], $data['name']);
        $meeting_params->setWelcomeMessage($data['welcome_message']);
        $meeting_params->setMaxParticipants($data['max_participants']);
        $meeting_params->setRecord(true);
        $meeting_params->setAllowStartStopRecording(true);
        $meeting_params->setAutoStartRecording(false);
        $response = $bbb->createMeeting($meeting_params);
        if ($response->getReturnCode() == 'FAILED') {
            throw new Exception('Can\'t create room! please contact our administrator.');
        }
        return $response;
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
            $this->createBigBlueButtonMeeting($meeting->toArray());
        }
        return true;
    }

    /**
     * Check if the meeting exists and is has not been forcibly ended
     */
    protected function isMeetingExistsAndRuninng($meeting, BigBlueButton $bbb): bool
    {
        if (Cache::has('is_meeting_exists_' . $meeting->name)) {
            return Cache::get('is_meeting_exists_' . $meeting->name);
        }
        $get_meeting_info_params = new GetMeetingInfoParameters($meeting->name);
        $response = $bbb->getMeetingInfo($get_meeting_info_params);
        return Cache::remember('is_meeting_exists_' . $meeting->name, now()->addMinutes(5), fn() => $response->getReturnCode() == 'SUCCESS' && !$response->getMeeting()->hasBeenForciblyEnded());
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
        $data['meeting_id'] = $data['name'];
        $data['is_scheduled'] = @$data['is_scheduled'] == 'on';
        return $data;
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query();
        return DataTables::of($query)
            ->setTransformer($this->model->transformer)
            ->make(true);
    }

    /**
     * fetching bbb recordings
     * @param mixed $meeting
     * @return void
     */
    public function getRecordings(): array
    {
        $db_records = $this->model->pluck('name')->toArray();
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
        return cacheAndGet('recordings_list', now()->addHour(2), $recordings_list);
    }

    /**
     * Get All Recordings Form BBB server Directrly regradless the Meetings in this system.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRecordings(): Collection
    {
        $recordings_list = AllRecording::query()->get();
        if (!Cache::has('all_recordings_list')) {

            $bbb = new BigBlueButton();
            $recordings_params = new GetRecordingsParameters();
            $recordings = $bbb->getRecordings($recordings_params);
            if ($recordings->getReturnCode() == 'SUCCESS') {
                foreach ($recordings->getRecords() as $record) {
                    AllRecording::query()->updateOrCreate([
                        'record_id' => $record->getRecordId(),
                    ], [
                        'record_id' => $record->getRecordId(),
                        'name' => $record->getName(),
                        'meeting_id' => $record->getMeetingId(),
                        'playback_url' => $record->getPlaybackUrl(),
                        'end_time' => $record->getEndTime(),
                        'duration' => $record->getPlaybackLength(),
                        'meta_data' => json_encode($record->getMetas()),
                    ]);
                }
                $recordings_list = AllRecording::query()->get();
            }
        }
        return cacheAndGet('all_recordings_list', now()->addDay(), $recordings_list);
    }



    public function getTableDataForRecordings(Request $request)
    {
        if (Cache::has('recordings_list')) {
            $query = Cache::get('recordings_list');
        } else {
            $query = $this->getRecordings();
        }
        return DataTables::collection($query)
            ->setTransformer(RecordingTransformer::class)
            ->make(true);
    }




}
