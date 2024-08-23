<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Participant;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data['meetings_count'] = Meeting::query()->count();
        $data['participants_count'] = Participant::query()->count();
        return view('user.dashboard' ,$data);
    }
}
