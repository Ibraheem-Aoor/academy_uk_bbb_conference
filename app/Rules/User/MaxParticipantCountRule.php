<?php

namespace App\Rules\User;

use App\Models\User\UserMeetingRoom;
use Google\Service\HangoutsChat\Resource\Rooms;
use Illuminate\Contracts\Validation\Rule;

class MaxParticipantCountRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $room;
    public function __construct(string $meeting_id)
    {
        $this->room = UserMeetingRoom::query()
            ->whereHas('meetings', function ($query) use ($meeting_id) {
                $query->where('id', decrypt($meeting_id));
            })->firstOrFail();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $participants)
    {
        $total_room_meetings_participants = $this->room->meetings()->withCount('createdParticipants')->get()->sum('created_participants_count');
        if(count($participants) == $total_room_meetings_participants && $total_room_meetings_participants < $this->room->max_participants ){
            return true;
        }
        $totalParticipants = $total_room_meetings_participants + count($participants);
        if ($totalParticipants > $this->room->max_participants || count($participants) > $this->room->max_participants) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('general.max_particpants_count', ['count' => $this->room->max_participants]);
    }
}
