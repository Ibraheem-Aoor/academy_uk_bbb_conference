<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\MeetingService;
use App\Services\UserMeetingService;
use Illuminate\Http\Request;

class UserRecordingController extends UserBaseController
{
    public function __construct(protected UserMeetingService $service)
    {
        $this->base_route_path = 'user.recording';
        $this->base_view_path = 'user.recordings';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Saved Recordings';
        $data['table_data_url'] = route($this->base_route_path . '.table');
        $data['route'] = $this->base_route_path;
        return view('user.recordings.index', $data);

    }

    public function allRecordings(Request $request)
    {
        $data['page_title'] = 'All Recordings';
        $data['recordings'] = $this->service->getAllRecordings();
        return view('admin.recordings.all' , $data);

    }


    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableDataForRecordings($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }
}
