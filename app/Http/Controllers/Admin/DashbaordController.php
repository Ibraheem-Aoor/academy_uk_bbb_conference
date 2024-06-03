<?php

namespace App\Http\Controllers\Admin;

use App\Enums\WebshopEnum;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\Webshop;
use App\Services\Api\BolService;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function dashboard()
    {
        Participant::where('meeting_id', 9)->whereRole('MODERATOR')->chunkyById(
            10,
            function ($pars) {
                foreach ($pars as $par) {
                    $par->update([
                        'bridge_url' => route('site.join_meeting', ['meeting' => encrypt($par->meeting_id), 'user' => encrypt($par->name)])
                    ]);
                }
            }
        );
        $data['meetings_count'] = Meeting::query()->count();
        $data['participants_count'] = Participant::query()->count();
        return view('admin.dashboard' , $data);
    }
}
