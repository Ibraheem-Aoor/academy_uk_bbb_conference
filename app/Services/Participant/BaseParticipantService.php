<?php
namespace App\Services\Participant;

use App\Jobs\ScheduleMeetingJob;
use App\Models\BaseModels\BaseMeetingParticipantModel;
use App\Services\BaseModelService;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class BaseParticipantService extends BaseModelService
{
    /**
     * Create Generic Participant Service
     * @param mixed $model
     */
    public function __construct(protected $model)
    {
        $this->model = $model;
    }

    /**
     * Create a join URL for a participant to join a meeting
     *
     * @param array $participant
     * @param BaseMeetingModel $meeting
     * @return string
     */
    public function createJoinUrl(array $participant,  $meeting): string
    {
        $bbb = new BigBlueButton();
        // $moderator_password for moderator
        $joinMeetingParams = new JoinMeetingParameters($meeting->meeting_id, $participant['name'], $participant['role']);
        $joinMeetingParams->setRedirect(true);
        $joinMeetingParams->setGuest(isset($participant['is_guest']));
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
        return $url;
    }

    /**
     * Update meeting participants
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, $request)
    {
        $meeting = $this->model->meeting_model::query()->find($id);

        try {
            if (isset($meeting->max_participants) && count($request->participants) > $meeting->max_participants) {
                throw new Exception('Max participants count is: ' . $meeting->max_participants);
            }
            $existingIds = collect($request->participants)->pluck('id')->filter();
            $meeting->participants()->whereNotIn('id', $existingIds)->delete();
            collect($request->participants)->map(function ($participantData) use ($meeting) {
                $participantData = $this->getModelAttributes($participantData);
                $participantData['join_url'] = $this->createJoinUrl($participantData, $meeting);
                if (isset($participantData['id']) && $participantData['id']) {
                    $participant = $meeting->participants()->find($participantData['id']);
                    $participant->update($participantData);
                } else {
                    $meeting->participants()->create($participantData);
                }
                return $participantData;
            })->toArray();

            if ($meeting->is_scheduled) {
                ScheduleMeetingJob::dispatch($meeting);
            }
            return generateResponse(status: true, modal_to_hide: '#add-meeting-users-modal', table_reload: true, table: '#myTable');

        } catch (Throwable $e) {
            Log::error("Fail with updating participants: " . $e->getMessage());
            return generateResponse(status: false, message: __($e->getMessage()));

        }
    }


    /**
     * Format The User Data And Plan Data.
     * @param mixed $request
     * @return array
     */
    protected function getModelAttributes($participant)
    {
        if (getAuthUser('web')) {
            $participant['created_by'] = getAuthUser('web')->id;
        }
        $participant['bridge_password'] = @$participant['password'];
        return $participant;
    }




}
