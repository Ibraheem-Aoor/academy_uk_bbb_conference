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
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMeeting extends Model
{
    use HasFactory , SoftDeletes;


    public $transformer = UserMeetingTransformer::class;
    public $modal = '#meeting-modal';

    protected $guarded = ['id', '_token'];


    /**
     * Register the observer on the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::observe(UserMeetingObserver::class);
    }



    /**
     * Get all participants that belong to this meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants(): HasMany
    {
        return $this->hasMany(UserMeetingParticipant::class, 'meeting_id');
    }

    /**
     * Get all participants created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdParticipants(): HasMany
    {
        return $this->hasMany(UserMeetingParticipant::class, 'meeting_id')->whereNotNull('created_by');
    }


    /**
     * The user that created this meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The room that this meeting belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(UserMeetingRoom::class, 'room_id');
    }


}
