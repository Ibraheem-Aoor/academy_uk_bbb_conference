<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRoomManagerRequest;
use App\Services\MeetingService;
use App\Services\UserMeetingService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RoomManagerController extends UserBaseController
{
    public function __construct(protected UserService $service)
    {
        $this->base_route_path = 'user.room_managers';
        $this->base_view_path = 'user.room_managers';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'All  Managers';
        $data['table_data_url'] = route($this->base_route_path . '.table');
        $data['route'] = $this->base_route_path;
        $data['modal'] = $this->service->getModal('room_manager_modal');
        $data['rooms'] = getAuthUser('web')->rooms;
        return view($this->base_view_path . '.index', $data);
    }

    public function store(StoreRoomManagerRequest $request)
    {
        return $this->service->createManager($request);
    }

    public function update($id , StoreRoomManagerRequest $request)
    {
        return $this->service->updateManager(decrypt($id) , $request);
    }


    public function toggleStatus(Request $request)
    {
        $response = $this->service->toggleStatus($request->id);
        return response()->json($response);
    }

    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getRoomMangersTable($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }
}
