<?php

namespace App\Http\Controllers\User;

use App\Enums\RoleEnum;
use App\Exports\MeetingExport;
use App\Http\Controllers\Controller;
use App\Services\UserMeetingService;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreMeetingRequest;
use App\Http\Requests\User\StoreQuickMeetingRequest;
use App\Models\User\UserMeeting;
use Illuminate\Support\Facades\Log;
use Throwable;
use Maatwebsite\Excel\Facades\Excel;


class UserMeetingController extends UserBaseController
{

    public function __construct(protected UserMeetingService $service)
    {
        $this->base_route_path = 'user.meeting';
        $this->base_view_path = 'user.meetings';
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
        return view($this->base_view_path.'.index', $data);
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

    public function  quickStore(StoreQuickMeetingRequest $request)
    {
       return $this->service->createQuickMeeting($request);
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


    public function export($meeting)
    {
        try {
            $meeting = UserMeeting::query()->find($meeting);
            $fileName = 'meeting-' . $meeting->name . '.xlsx';
            return Excel::download(new MeetingExport($meeting), $fileName);
        } catch (Throwable $e) {
            dd($e);
            Log::error("Fail with export: " . $e->getMessage());
            return back()->with('error', 'No Participants To Export');
        }
    }
}
