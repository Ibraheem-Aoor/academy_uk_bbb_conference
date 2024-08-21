<?php

namespace App\Http\Controllers\Admin;

use App\Enums\WebshopEnum;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\Webshop;
use App\Notifications\MeetingScheduled;
use App\Services\Api\BolService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class DashbaordController extends Controller
{
    public function dashboard()
    {
        $data['meetings_count'] = Meeting::query()->count();
        $data['participants_count'] = Participant::query()->count();
        return view('admin.dashboard', $data);
    }
}
