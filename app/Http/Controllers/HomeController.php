<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\SiteJoinMeetingRequest;
use App\Mail\TestMail;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\Webshop;
use App\Services\MeetingService;
use App\Services\ParticipantService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->page_title = "JOIN MEETING";
        $this->base_view_path = "site.";
    }

    public function joinMeetingShowForm($meeting, $user)
    {
        $db_meeting = Meeting::query()->findOrFail(decrypt($meeting));
        $data = [
            'meeting' => $db_meeting,
            'participant' => Participant::query()->where('meeting_id', $db_meeting->id)->where('name', decrypt($user))->first(),
            'page_title' => $this->page_title,
            'is_login_page' => true,
            'form_url' => route('site.join_meeting.submit', ['meeting' => $meeting, 'user' => $user]),
        ];
        return view($this->base_view_path . 'join_meeting', $data);
    }
    public function joinPublicMeetingShowForm($meeting)
    {
        $db_meeting = Meeting::query()->findOrFail(decrypt($meeting));
        $data = [
            'meeting' => $db_meeting,
            'page_title' => $this->page_title,
            'is_login_page' => true,
            'form_url' => route('site.join_public_meeting.submit', ['meeting' => $meeting]),
        ];
        return view($this->base_view_path . 'join_public_meeting', $data);
    }


    public function joinMeeting($meeting, $user, SiteJoinMeetingRequest $request)
    {
        try {
            $db_meeting = Meeting::query()->findOrFail(decrypt($meeting));
            $participant = Participant::query()->where('meeting_id', $db_meeting->id)->where('name', decrypt($user))->firstOrFail();
            $this->activateMeeting($db_meeting);
            if ($participant->name != $request->name) {
                return generateResponse(status: false, message: "Unauthorized User");
            }
            if (isset($request->password) && $participant->bridge_password == $request->password) {
                return generateResponse(status: true, message: __('response.redirecting'), redirect: $participant->join_url);
            }
            if (!isset($request->password) && $participant->role == RoleEnum::MODERATOR->value) {
                return generateResponse(status: true, message: __('response.redirecting'), redirect: $participant->join_url);
            }
            if (!isset($request->password) && !isset($participant->bridge_password)) {
                return generateResponse(status: true, message: __('response.redirecting'), redirect: $participant->join_url);
            }
            return generateResponse(status: false, message: "Unauthorized User");
        } catch (Throwable $e) {
            info('Error While Join Meeting In :' . __METHOD__ . ' :' . $e->getMessage());
            return generateResponse(status: false, message: "Something Went Wrong");
        }
    }
    public function joinPublicMeeting($meeting, SiteJoinMeetingRequest $request)
    {
        try {
            $db_meeting = Meeting::query()->findOrFail(decrypt($meeting));
            ini_set('max_execution_time', 500);
            $this->activateMeeting($db_meeting);
            if (Participant::query()->where('name', $request->name)->where('meeting_id', $db_meeting->id)->exists()) {
                return generateResponse(status: false, message: "Participant Already Exists.Enter Your Full Name");
            }
            DB::beginTransaction();
            $participant = Participant::query()->create(
                [
                    'name' => $request->name,
                    'meeting_id' => $db_meeting->id,
                    'join_url' => $this->generateJoinUrl($db_meeting, $request->name),
                    'bridge_url' => route('site.join_meeting', ['meeting' => $meeting, 'user' => encrypt($request->name)]),
                ]
            );
            DB::commit();
            return generateResponse(status: true, message: __('response.redirecting'), redirect: $participant->join_url);
        } catch (Throwable $e) {
            DB::rollBack();
            info('Error While Join Meeting In :' . __METHOD__ . ' :' . $e->getMessage());
            return generateResponse(status: false, message: "Something Went Wrong");

        }
    }


    public function activateMeeting($meeting)
    {
        return (new MeetingService())->activate($meeting);
    }

    public function generateJoinUrl($meeting, $name)
    {
        return (new ParticipantService())->createJoinUrl(['name' => $name, 'role' => RoleEnum::VIEWER->value], $meeting);

    }

}
