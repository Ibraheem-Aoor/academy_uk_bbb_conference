<?php
namespace App\Services;

use App\Services\BaseModelService;
use BigBlueButton\Parameters\IsMeetingRunningParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Meeting;
use App\Models\Participant;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use Exception;
use Illuminate\Support\Facades\Cache;
use SimpleXMLElement;
use Yajra\DataTables\Contracts\DataTable;

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
            $data = $request->toArray();
            $data['meeting_id'] = $data['name'];
            $this->createBigBlueButtonMeeting($data);
            Meeting::create($data);
            return generateResponse(status: true, modal_to_hide: $this->model->modal, table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }


    protected function createBigBlueButtonMeeting(array $data)
    {
        $bbb = new BigBlueButton();
        $meeting_params = new CreateMeetingParameters($data['name'], $data['name']);
        $meeting_params->setWelcomeMessage($data['welcome_message']);
        $meeting_params->setMaxParticipants($data['max_participants']);
        $meeting_params->setRecord(true);
        $meeting_params->setAllowStartStopRecording(true);
        $meeting_params->setAutoStartRecording(false);
        $response = $bbb->createMeeting($meeting_params);
        if ($response->getReturnCode() == 'FAILED') {
            throw new Exception('Can\'t create room! please contact our administrator.');
        } else {
            return $response;
        }
    }



    public function activate($meeting)
    {
        $bbb = new BigBlueButton();

        if (!$this->isMeetingExists($meeting, $bbb) && !$this->isMeetingRunning($meeting, $bbb)) {
            $this->createBigBlueButtonMeeting($meeting->toArray());
        }
        return true;
    }

    protected function isMeetingRunning($meeting, BigBlueButton $bbb): bool
    {
        if (Cache::has('is_meeting_running_' . $meeting->name)) {
            return Cache::get('is_meeting_running_' . $meeting->name);
        }
        $params = new IsMeetingRunningParameters($meeting->name);
        $response = $bbb->isMeetingRunning($params);
        return Cache::remember('is_meeting_running_' . $meeting->name, now()->addMinutes(5), fn() => $response->getReturnCode() == 'SUCCESS' && $this->getAttributeFromXml('running') == 'true');
    }

    protected function isMeetingExists($meeting, BigBlueButton $bbb): bool
    {
        if (Cache::has('is_meeting_exists_' . $meeting->name)) {
            return Cache::get('is_meeting_exists_' . $meeting->name);
        }
        $get_meeting_info_params = new GetMeetingInfoParameters($meeting->name);
        $response = $bbb->getMeetingInfo($get_meeting_info_params);
        return Cache::remember('is_meeting_exists_' . $meeting->name, now()->addMinutes(5), fn() => $response->getReturnCode() == 'SUCCESS');
    }


    protected function getAttributeFromXml($attribute)
    {
        // Assuming you have the SimpleXMLElement object
        $xmlObject = new SimpleXMLElement('<response><returncode>SUCCESS</returncode><running>false</running></response>');

        // Access the running attribute directly
        $result = (string) $xmlObject->$attribute;

        return $result;
    }


    protected function getModelAttributes($request)
    {
        //
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





}
