<?php
namespace App\Services;

use App\Jobs\ScheduleMeetingJob;
use App\Models\User\UserMeetingParticipant;
use App\Services\BaseModelService;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\User\UserMeeting;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use Carbon\Carbon;
use Exception;
use Spatie\GoogleCalendar\Event;


class UserParticipantService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new UserMeetingParticipant());
        $this->allow_all_records = true;
    }


    // create model
    public function create(Request $request)
    {
        $meeting = UserMeeting::findOrFail(($request->route('meeting')));
        try {
            if (count($request->participants) > $meeting->max_participants) {
                throw new Exception('Max participants count is: ' . $meeting->max_participants);
            }
            foreach ($request->participants as $participant) {
                $join_url = $this->createJoinUrl($participant, $meeting);
                $participant['bridge_password'] = @$participant['password'];
                $participant_created =  UserMeetingParticipant::query()->updateOrCreate(
                    [
                        'name' => $participant['name'],
                        'meeting_id' => $meeting->id,
                    ],
                    [
                        'name' => $participant['name'],
                        'role' => $participant['role'],
                        'is_guest' => isset($participant['is_guest']) ? true : false,
                        'join_url' => $join_url,
                        'meeting_id' => $meeting->id,
                        'created_by' => getAuthUser('web')->id,
                        'email' => @$participant['email'],
                        ]
                    );
                    $participant_created->bridge_url = route('site.user.join_meeting', ['meeting' => ($meeting->meeting_id), 'user' => encrypt($participant_created->id)]);
                    $participant_created->save();
                    dd($participant_created);
            }
            return generateResponse(status: true, modal_to_hide: '#add-meeting-users-modal', table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }


    public function createJoinUrl(array $participant, UserMeeting $meeting)
    {
        $bbb = new BigBlueButton();

        // $moderator_password for moderator
        $joinMeetingParams = new JoinMeetingParameters($meeting->meeting_id, $participant['name'], $participant['role']);
        $joinMeetingParams->setRedirect(true);
        $joinMeetingParams->setGuest(isset($participant['is_guest']));
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
        return $url;
    }


    public function update($id, $request)
    {
        $meeting = UserMeeting::findOrFail($id);

        try {
            if (isset($meeting->max_participants) &&  count($request->participants) > $meeting->max_participants) {
                throw new Exception('Max participants count is: ' . $meeting->max_participants);
            }
            $existingIds = collect($request->participants)->pluck('id')->filter();
            $meeting->participants()->whereNotIn('id', $existingIds)->delete();
            foreach ($request->participants as $participantData) {
                $participantData['bridge_url'] = route('site.user.join_meeting', ['meeting' => ($meeting->meeting_id), 'user' => encrypt($participantData['id'])]);
                $participantData['bridge_password'] = @$participantData['password'];
                $participantData['created_by'] = getAuthUser('web')->id;
                if (isset($participantData['id']) && $participantData['id']) {
                    $participant = $meeting->participants()->find($participantData['id']);
                    $participant->update($participantData);
                } else {
                    $join_url = $this->createJoinUrl($participantData, $meeting);
                    $participantData['join_url'] = $join_url;
                    $meeting->participants()->create($participantData);
                    $meeting->participants()->chunkById(10,function($participants)use($meeting){
                        foreach($participants as $participant){
                            $participant->update([
                                'bridge_url' => route('site.user.join_meeting', ['meeting' => ($meeting->meeting_id), 'user' => encrypt($participant->id)]),
                            ]);
                        }
                    });
                }
            }
            if ($meeting->is_scheduled) {
                ScheduleMeetingJob::dispatch($meeting);
            }
            return generateResponse(status: true, modal_to_hide: '#add-meeting-users-modal', table_reload: true, table: '#myTable');

        } catch (Throwable $e) {
            Log::error("Fail with updating participants: " . $e->getMessage());
            return generateResponse(status: false, message: __($e->getMessage()));

        }
    }






    protected function getModelAttributes($request)
    {
        //
    }







}
