<?php

namespace App\Observers;

use App\Models\User\UserMeeting;

class UserMeetingObserver
{
    public function created(UserMeeting $meeting)
    {
        $this->updateStatus($meeting);
    }

    public function updated(UserMeeting $meeting)
    {
        $this->updateStatus($meeting);
    }

    private function updateStatus(UserMeeting $meeting)
    {
        $working_rooms = $meeting->user->rooms()->whereHas(
            'meetings',
            function ($meetings) {
                $meetings->where('status', 1);
            }
        )->count();

        if ($working_rooms > $meeting->user->plan->parallel_rooms) {

            // Update the status without firing any events
            $meeting->withoutEvents(function () use ($meeting) {
                $meeting->room->meetings()->update(['status' => 0]);
            });
        }
    }
}
