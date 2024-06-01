<?php
namespace App\Services;

use App\Services\BaseModelService;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Meeting;
use App\Models\Participant;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use Exception;

class ParticipantService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new Participant());
        $this->allow_all_records = true;
    }


    // create model
    public function create(Request $request)
    {
        $meeting = Meeting::findOrFail(($request->route('meeting')));

        try {
            if (count($request->participants) > $meeting->max_participants) {
                throw new Exception('Max participants count is: ' . $meeting->max_participants);
            }
            foreach ($request->participants as $participant) {
                $join_url = $this->createJoinUrl($participant, $meeting);
                $bridge_url = route('site.join_meeting', ['meeting' => encrypt($meeting->id), 'user' => encrypt($participant['name'])]);
                $participant['bridge_password'] = @$participant['password'];
                Participant::query()->updateOrCreate(
                    [
                        'name' => $participant['name'],
                        'meeting_id' => $meeting->id,
                    ],
                    [
                        'name' => $participant['name'],
                        'role' => $participant['role'],
                        'is_guest' => isset($participant['is_guest']) ? true : false,
                        'join_url' => $join_url,
                        'bridge_url' => $bridge_url,
                        'meeting_id' => $meeting->id,
                    ]
                );
            }
            return generateResponse(status: true, modal_to_hide: '#add-meeting-users-modal', table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            Log::error("Fail with adding participants: " . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
    }


    public function createJoinUrl(array $participant, Meeting $meeting)
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
        $meeting = Meeting::findOrFail($id);

        try {
            if (count($request->participants) > $meeting->max_participants) {
                throw new Exception('Max participants count is: ' . $meeting->max_participants);
            }
            $existingIds = collect($request->participants)->pluck('id')->filter();
            $meeting->participants()->whereNotIn('id', $existingIds)->delete();
            foreach ($request->participants as $participantData) {
                $participantData['bridge_url'] = route('site.join_meeting', ['meeting' => encrypt($meeting->id), 'user' => encrypt($participantData['name'])]);
                $participantData['bridge_password'] = @$participantData['password'];
                if (isset($participantData['id']) && $participantData['id']) {
                    $participant = $meeting->participants()->find($participantData['id']);
                    $participant->update($participantData);
                } else {
                    $join_url = $this->createJoinUrl($participantData, $meeting);
                    $participantData['join_url'] = $join_url;
                    $meeting->participants()->create($participantData);
                }
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
