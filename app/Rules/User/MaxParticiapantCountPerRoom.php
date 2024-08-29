<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;

class MaxParticiapantCountPerRoom implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $room;

    protected $message;
    public function __construct(protected $room_id)
    {
        $user = getAuthUser('web');
        $this->room = $user->rooms->find($this->room_id);
        $this->message = __('general.max_particpants_count', ['count' => $this->room->max_participants]);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $maxRoomParticipants = $attribute === 'room' ? $this->room->max_participants : $value;

        $totalParticipants = $this->room->meetings()->sum('max_participants') + $maxRoomParticipants;
        $totalRoomMeetings = $this->room->meetings()->count() + 1;

        if ($this->room->max_meetings < $totalRoomMeetings) {
            $this->message = __('general.max_meetings_per_room_reached', ['count' => $this->room->max_meetings]);
            return false;
        }

        if ($totalParticipants > $this->room->max_participants) {
            $this->message = __('general.max_particpants_per_room_reached', ['count' => $this->room->max_participants]);
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
        return $this->message;
    }
}
