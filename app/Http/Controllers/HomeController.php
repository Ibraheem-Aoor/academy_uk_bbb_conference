<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\SiteJoinMeetingRequest;
use App\Mail\TestMail;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\Webshop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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


    public function joinMeeting($meeting, $user, SiteJoinMeetingRequest $request)
    {
        try {
            $db_meeting = Meeting::query()->findOrFail(decrypt($meeting));
            $participant = Participant::query()->where('meeting_id', $db_meeting->id)->where('name', decrypt($user))->firstOrFail();
            if ($participant->name != $request->name) {
                return generateResponse(status: false, message: "Unauthorized User");
            }
            if (isset($request->password) && $participant->bridge_password == $request->password) {
                return generateResponse(status: true, redirect: $participant->join_url);
            }
            if (!isset($request->password) && $participant->role == RoleEnum::MODERATOR->value) {
                return generateResponse(status: true, redirect: $participant->join_url);
            }
            if (!isset($request->password) && !isset($participant->bridge_password)) {
                return generateResponse(status: true, redirect: $participant->join_url);
            }
            return generateResponse(status: false, message: "Unauthorized User");
        } catch (Throwable $e) {
            info('Error While Join Meeting In :' . __METHOD__ . ' :' . $e->getMessage());
            return back()->with('error', 'Something Went Wrong');
        }
    }

}
