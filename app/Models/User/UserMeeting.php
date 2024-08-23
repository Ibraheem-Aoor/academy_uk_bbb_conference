<?php

namespace App\Models\User;

use App\Transformers\Admin\MeetingTransformer;
use App\Transformers\User\UserMeetingTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserMeeting extends Model
{
    use HasFactory;


    public $transformer = UserMeetingTransformer::class;
    public $modal = '#meeting-modal';

    protected $guarded = ['id', '_token'];

    public function participants(): HasMany
    {
        return $this->hasMany(UserMeetingParticipant::class , 'meeting_id');
    }

    public function createdParticipants() : HasMany
    {
        return $this->hasMany(UserMeetingParticipant::class , 'meeting_id')->whereNotNull('created_by');
    }
}
