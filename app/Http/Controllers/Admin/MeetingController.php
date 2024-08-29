<?php
namespace App\Http\Controllers\Admin;


use App\Enums\AccountTreeTypeEnum;
use App\Enums\RoleEnum;
use App\Exports\MeetingExport;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMeetingParticipantsRequest;
use App\Http\Requests\Admin\StoreMeetingRequest;
use App\Models\Meeting;
use App\Services\AccountTreeService;
use App\Services\MeetingService;
use App\Services\ParticipantService;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class MeetingController extends AdminBaseController
{

    public function __construct(protected MeetingService $service)
    {
        $this->base_route_path = 'admin.meeting';
        $this->base_view_path = 'admin.meetings';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Meetings';
        $data['roles'] = RoleEnum::cases();
        $data['table_data_url'] = route($this->base_route_path . '.table');
        $data['route'] = $this->base_route_path;
        return view('admin.meetings.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetingRequest $request)
    {
        $response = $this->service->create($request);
        return response()->json($response);
    }


    /**
     * Join the meeting as moderator
     *
     *
     * @param  Request  $request
     * @param  string  $meeting
     * @param  ParticipantService  $participant_service
     * @return \Illuminate\Http\Response
     */
    public function joinAsModerator(Request $request, $meeting , ParticipantService $participant_service)
    {
        $meeting = Meeting::findOrFail(decrypt($meeting));
        $user = getAuthUser('admin');
        $this->service->activate($meeting);
        return redirect($participant_service->createJoinUrl(['name' => $user->name, 'role' => RoleEnum::MODERATOR->value], $meeting));
    }

    public function addUsers(StoreMeetingParticipantsRequest $request, $id)
    {
        $meeting = Meeting::findOrFail(decrypt($id));

        try {
            foreach ($request->participants as $participantData) {
                $meeting->participants()->create($participantData);
            }
            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            Log::error("Fail with adding participants: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => __('response.error')]);
        }
    }


    public function getParticipants($id)
    {
        $meeting = Meeting::with('participants')->findOrFail($id);
        return response()->json(['participants' => $meeting->participants]);
    }

    public function updateParticipants(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        try {
            $existingIds = collect($request->participants)->pluck('id')->filter();
            $meeting->participants()->whereNotIn('id', $existingIds)->delete();

            foreach ($request->participants as $participantData) {
                if (isset($participantData['id']) && $participantData['id']) {
                    $participant = $meeting->participants()->find($participantData['id']);
                    $participant->update($participantData);
                } else {
                    $meeting->participants()->create($participantData);
                }
            }
            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            Log::error("Fail with updating participants: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => __('response.error')]);
        }
    }


    public function toggleStatus(Request $request)
    {
        $response = $this->service->toggleStatus($request->id);
        return response()->json($response);
    }







    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableData($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }


    public function export(Meeting $meeting)
    {
        try {
            $fileName = 'meeting-' . $meeting->name . '.xlsx';
            return Excel::download(new MeetingExport($meeting), $fileName);
        } catch (Throwable $e) {
            Log::error("Fail with export: " . $e->getMessage());
            return back()->with('error', 'No Participants To Export');
        }
    }
}
