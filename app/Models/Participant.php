<?php

namespace App\Models;

use App\Models\BaseModels\BaseMeetingParticipantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Participant extends BaseMeetingParticipantModel
{

    protected $guarded = ['id' , '_token'];

    public  $meeting_model = Meeting::class;

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class , 'meeting_id');
    }

    /**
     * Generate a join URL for a participant to join a meeting
     *
     * @param string $user
     * @return string
     */
    public function generateBridgeUrlForParticipant()
    {
        return route('site.join_meeting', ['meeting' => encrypt($this->meeting_id), 'user' => encrypt($this->name)]);
    }
}
