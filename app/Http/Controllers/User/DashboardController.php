<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserMeetingRoomRequest;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\User\UserMeeting;
use App\Models\User\UserMeetingParticipant;
use App\Services\UserMeetingRoomService;
use Illuminate\View\View;

class DashboardController extends UserBaseController
{

    public function index():View
    {
        $data['rooms'] = $this->user->rooms;
        return view('user.home' , $data);
    }
    public function dashboard(): View
    {
        $data['meetings_count'] = UserMeeting::query()->whereBelongsTo(getAuthUser('web'))->count();
        $data['participants_count'] = UserMeetingParticipant::query()->whereHas('meeting' , function($meeting){
            $meeting->whereBelongsTo(getAuthUser('web'));
        })->count();
        $data['successfull_joins'] = UserMeeting::query()->whereBelongsTo(getAuthUser('web'))->sum('successfull_joins');
        $data['failed_joins'] = UserMeeting::query()->whereBelongsTo(getAuthUser('web'))->sum('failed_joins');
        $data['upcoming_meetings'] = UserMeeting::query()->whereBelongsTo(getAuthUser('web'))
            ->where('is_scheduled', 1)
            ->where('start_date', today()->toDateString())
            ->orWhere('start_date', today()->addDay()->toDateString())
            ->get();

        // Get meetings and participants count per month
        $monthlyData = UserMeeting::query()->whereBelongsTo(getAuthUser('web'))
            ->selectRaw('MONTH(start_date) as month, COUNT(*) as meetings, SUM(successfull_joins) as participants')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $months = collect(range(1, 12))->map(function($month) use ($monthlyData) {
            return [
                'meetings' => $monthlyData->get($month)->meetings ?? 0,
                'participants' => $monthlyData->get($month)->participants ?? 0,
            ];
        });

        $data['monthly_meetings'] = $months->pluck('meetings');
        $data['monthly_participants'] = $months->pluck('participants');

        return view('user.dashboard', $data);
    }

    public function updateRoom($room , UpdateUserMeetingRoomRequest $request , UserMeetingRoomService $user_meeting_room_service)
    {
        return $user_meeting_room_service->updateName(decrypt($room) , $request);
    }

}
