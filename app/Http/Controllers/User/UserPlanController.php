<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\MeetingService;
use App\Services\UserMeetingService;
use App\Services\UserPlanService;
use Illuminate\Http\Request;

class UserPlanController extends UserBaseController
{
    public function __construct(protected UserPlanService $service)
    {
        $this->base_route_path = 'user.plan';
        $this->base_view_path = 'user.plans';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Current Subscription';
        $data['route'] = $this->base_route_path;
        $data['plan'] = $this->service->getAuthUserCurrentPlan();
        $data['user'] = getAuthUser('web');
        return view($this->base_view_path . '.index', $data);
    }
}
