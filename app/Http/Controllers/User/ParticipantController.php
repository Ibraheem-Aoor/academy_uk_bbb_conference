<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreMeetingParticipantsRequest;
use App\Models\User\UserMeeting;
use App\Services\ParticipantService;
use App\Services\UserParticipantService;
use Illuminate\Http\Request;

class ParticipantController extends UserBaseController
{
    public function __construct(protected UserParticipantService $service)
    {
        $this->base_route_path = 'user.meeting';
        $this->base_view_path = 'user.meetings';
    }


    public function getParticipants($id)
    {
        $meeting = UserMeeting::with('createdParticipants')->findOrFail(decrypt($id));
        return response()->json(['participants' => $meeting->createdParticipants]);
    }

    public function updateParticipants(StoreMeetingParticipantsRequest $request, $id)
    {
        return $this->service->update(decrypt($id) , $request);
    }

}
