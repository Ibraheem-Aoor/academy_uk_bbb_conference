<?php

namespace App\Models\User;

use App\Models\BaseModels\BaseMeetingParticipantModel;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class UserMeetingParticipant extends BaseMeetingParticipantModel
{
    protected $guarded = ['__token', 'id'];
    public  $meeting_model = UserMeeting::class;



    public function meeting(): BelongsTo
    {
        return $this->belongsTo(UserMeeting::class, 'meeting_id');
    }

    /**
     * Generate a join URL for a participant to join a meeting
     *
     * @param string $user
     * @return string
     */
    public function generateBridgeUrlForParticipant()
    {
        return route('site.user.join_meeting', ['meeting' => $this->meeting->meeting_id, 'user' => encrypt($this->id)]);
    }
}
