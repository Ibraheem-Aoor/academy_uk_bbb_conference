<?php

namespace App\Models\User;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMeetingParticipant extends Model
{
    use HasFactory;
    protected $guarded  = ['__token' , 'id'];


    public function meeting():BelongsTo
    {
        return $this->belongsTo(UserMeeting::class , 'meeting_id');
    }
}
