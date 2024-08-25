<?php
namespace App\Http\Controllers\Admin;


use App\Enums\AccountTreeTypeEnum;
use App\Enums\PlanTypeEnum;
use App\Enums\RoleEnum;
use App\Exports\MeetingExport;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMeetingParticipantsRequest;
use App\Http\Requests\Admin\StoreMeetingRequest;
use App\Http\Requests\Admin\StoreUserMeetingRoomRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\Meeting;
use App\Services\AccountTreeService;
use App\Services\MeetingService;
use App\Services\UserService;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class UserController extends AdminBaseController
{

    public function __construct(protected UserService $service)
    {
        $this->base_route_path = 'admin.user';
        $this->base_view_path = 'admin.users';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Users';
        $data['table_data_url'] = route($this->base_route_path . '.table');
        $data['route'] = $this->base_route_path;
        $data['modal'] = $this->service->getModal();
        $data['plan_types'] = PlanTypeEnum::cases();
        $data['room_modal'] = $this->service->getService('user_meeting_room_service')->getModal();
        return view($this->base_view_path . '.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $response = $this->service->create($request);
        return response()->json($response);
    }

    public function update($id , StoreUserRequest $request)
    {
        return $this->service->update(($id) , $request);
    }



    public function destroy($id)
    {
        return $this->service->delete(decrypt($id));
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

    public function updateRooms($user,StoreUserMeetingRoomRequest $request)
    {
        return $this->service->getService('user_meeting_room_service')->updateOrCreate(decrypt($user),$request);
    }

    public function getRooms($user , Request $request)
    {
        $user = $this->service->find(decrypt($user));
        return response()->json(['rooms' => $user->rooms]);
    }
}
