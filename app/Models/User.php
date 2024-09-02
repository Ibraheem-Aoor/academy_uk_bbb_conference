<?php

namespace App\Models;

use App\Enums\PlanTypeEnum;
use App\Models\User\UserMeetingRoom;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Jobs\SendEmailVerficationNotificationJob;
use App\Transformers\Admin\UserTransformer;
use App\Transformers\User\RoomManagerTransformer;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'plan_id',
        'is_room_manager',
        'password_text',
        'status',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $modal = '#user-modal';
    public $room_manager_modal = '#room-manager-modal';
    public $transformer = UserTransformer::class;
    public $room_manager_transformer = RoomManagerTransformer::class;
    public $renew_plan_modal = '#renew-plan-modal';

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /**
     * Get the rooms the user is allowed to enter.
     *
     * @return BelongsToMany
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(UserMeetingRoom::class, 'user_rooms', 'user_id', 'room_id')->wherePivot('status', 1);
    }
    /**
     * Get all rooms the user is associated with, regardless of whether or not
     * the user is currently allowed to enter the room.
     *
     * @return BelongsToMany
     */
    public function allRooms(): BelongsToMany
    {
        return $this->belongsToMany(UserMeetingRoom::class, 'user_rooms', 'user_id', 'room_id');
    }


    /**
     * Scope a query to only include users that are room managers.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsRoomManager($query, $value = 1)
    {
        return $query->where('is_room_manager', $value);
    }

}
