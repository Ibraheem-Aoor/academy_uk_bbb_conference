<?php

namespace App\Models\User;

use App\Transformers\User\UserMeetingRoomTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserMeetingRoom extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $modal =  '#room-modal';
    public $transformer = UserMeetingRoomTransformer::class;

    public function meetings(): HasMany
    {
        return $this->hasMany(UserMeeting::class , 'room_id');
    }

    /**
     * Retrieves the last meeting associated with the user meeting room.
     *
     * @return string The date and time of the last meeting in the format 'M d, Y h:i A', or an empty string if no meetings are found.
     */
    public function getLastMeeting()
    {
        $lastMeeting = $this->meetings()->latest()->first();
        return $lastMeeting ? $lastMeeting->created_at->format('M d, Y h:i A') : '';
    }

    public function getAtiveToString()
    {
        return $this->status ?  __('general.active') : __('general.inactive');
    }

}
