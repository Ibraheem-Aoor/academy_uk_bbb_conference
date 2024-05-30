<?php
namespace App\Http\Controllers\Admin;


use App\Enums\AccountTreeTypeEnum;
use App\Enums\RoleEnum;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMeetingParticipantsRequest;
use App\Http\Requests\Admin\StoreMeetingRequest;
use App\Models\Meeting;
use App\Services\AccountTreeService;
use App\Services\MettingService;
use App\Services\ParticipantService;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ParticipantController extends AdminBaseController
{

    public function __construct(protected ParticipantService $service)
    {
        $this->base_route_path = 'admin.meeting';
        $this->base_view_path = 'admin.meetings';
    }



    public function store(StoreMeetingParticipantsRequest $request, $id)
    {
        return $this->service->create($request);
    }


    public function getParticipants($id)
    {
        $meeting = Meeting::with('participants')->findOrFail($id);
        return response()->json(['participants' => $meeting->participants]);
    }

    public function updateParticipants(StoreMeetingParticipantsRequest $request, $id)
    {
        return $this->service->update($id , $request);
    }







}
