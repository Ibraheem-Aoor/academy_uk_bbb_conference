<?php

namespace App\Models\User;

use App\Models\User;
use App\Observers\UserMeetingObserver;
use App\Transformers\Admin\MeetingTransformer;
use App\Transformers\User\UserMeetingTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserMeeting extends Model
{
    use HasFactory;


    public $transformer = UserMeetingTransformer::class;
    public $modal = '#meeting-modal';

    protected $guarded = ['id', '_token'];

    protected static function booted()
    {
        static::observe(UserMeetingObserver::class);
    }



    public function participants(): HasMany
    {
        return $this->hasMany(UserMeetingParticipant::class, 'meeting_id');
    }

    public function createdParticipants(): HasMany
    {
        return $this->hasMany(UserMeetingParticipant::class, 'meeting_id')->whereNotNull('created_by');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(UserMeetingRoom::class, 'room_id');
    }
}
