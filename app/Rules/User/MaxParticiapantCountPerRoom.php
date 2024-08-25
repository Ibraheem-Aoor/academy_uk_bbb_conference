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
        $total_max_participants = ($this->room->meetings()?->sum('max_participants') ?? 0) + $value;
        $total_room_meetings = $this->room->meetings()->count() + 1;
        if ($this->room->max_meetings < $total_room_meetings || $this->room->max_meetings < $this->room->meetings()->count()) {
            $this->message = __('general.max_meetings_per_room_reached', ['count' => $this->room->max_meetings]);
            return false;
        }
        if (
            $attribute == 'max_participants'  && $total_max_participants > $this->room->max_participants
        ) {
            $this->message = __('general.max_particpants_per_room_reached', ['count' => $this->room->max_participants]);
            return false;
        }
        if (
            $this->room->max_participants >= $value
        ) {
            return true;
        }
        return false;
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
