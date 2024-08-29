<?php

namespace App\Http\Controllers\Admin;

use App\Enums\WebshopEnum;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\User;
use App\Models\User\UserMeeting;
use App\Models\User\UserMeetingParticipant;
use App\Models\User\UserMeetingRoom;
use App\Models\Webshop;
use App\Notifications\MeetingScheduled;
use App\Services\Api\BolService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Throwable;

class DashbaordController extends Controller
{
    public function dashboard()
    {
        $data['meetings_count'] = Meeting::query()->count();
        $data['participants_count'] = Participant::query()->count();
        $data['users_meeting_count'] = UserMeeting::query()->count();
        $data['user_meeting_participants_count'] = UserMeetingParticipant::query()->count();
        $data['user_room_count'] = UserMeetingRoom::query()->count();
        $data['user_room_manager_count'] = User::query()->isRoomManager(1)->count();
        return view('admin.dashboard', $data);
    }

    public function testMail(){
        try{

            Mail::to('ibraheem.alaoor@hotmail.com')->send(new TestMail);
            dd('DONE');
        }catch(Throwable $e){
            dd($e);
        }
    }
}
