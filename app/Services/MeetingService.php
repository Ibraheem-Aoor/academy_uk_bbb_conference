<?php
namespace App\Services;

use App\Services\BaseModelService;
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
use Exception;
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
        $meeting_params->setDuration($data['duration']);
        $meeting_params->setMaxParticipants($data['max_participants']);
        $meeting_params->setRecord(true);
        $meeting_params->setAllowStartStopRecording(true);
        $meeting_params->setAutoStartRecording(true);
        $response = $bbb->createMeeting($meeting_params);
        if ($response->getReturnCode() == 'FAILED') {
            throw new Exception('Can\'t create room! please contact our administrator.');
        } else {
            return $response;
        }
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
