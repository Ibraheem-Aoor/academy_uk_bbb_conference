<?php
namespace App\Services;

use App\Jobs\ScheduleMeetingJob;
use App\Services\BaseModelService;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Meeting;
use App\Models\Participant;
use App\Services\Participant\BaseParticipantService;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use Carbon\Carbon;
use Exception;
use Spatie\GoogleCalendar\Event;


class ParticipantService extends BaseParticipantService
{

    public function __construct()
    {
        parent::__construct(new Participant());
        $this->allow_all_records = true;
    }

}
