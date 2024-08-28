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

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(UserMeetingRoom::class, 'user_rooms', 'user_id', 'room_id');
    }


    public function scopeIsRoomManager($query, $value = 1)
    {
        return $query->where('is_room_manager', $value);
    }

    /**
     * Check User Subscription and disable if needed
     */
    public function updateSubscriptionStatus()
    {
        $this->status = 1;
        if (!$this->isPlanActive()) {
            $this->status = 0;
            info('Expired Subscription for User: ' . 'Name: ' . $this->name . ' ID: ' . $this->id);
        }
        $this->save();
    }
    /**
     * Check if the user's plan is currently active.
     *
     * This function checks the renewal date of the user's plan and compares it
     * to the current date. If the renewal date is not set, it uses the plan's
     * creation date instead. It then checks the plan type and calculates the
     * expiration date based on the plan type. If the expiration date is in the
     * future, the plan is considered active.
     *
     * @return bool True if the plan is active, false otherwise.
     */
    protected function isPlanActive(): bool
    {
        if(is_null($this->plan))
        {
            return false;
        }
        $last_history = $this->plan?->history()?->latest()?->first();
        $renewal_date = $last_history?->renewed_at;
        $plan_creation_date = $this->plan?->created_at;
        $date_to_compate = $renewal_date ?: $plan_creation_date;
        switch ($this->plan?->type) {
            case PlanTypeEnum::DAILY:
                return $date_to_compate->addDay()->isFuture();
            case PlanTypeEnum::WEEKLY:
                return $date_to_compate->addWeek()->isFuture();
            case PlanTypeEnum::MONTHLY:
                return $date_to_compate->addMonth()->isFuture();
            case PlanTypeEnum::ANNUALY:
                return $date_to_compate->addDays(365)->isFuture();
            default:
                return false;
        }
        return false;
    }
    // public function getPasswordTextAttribute()
    // {
    //     return Crypt::decryptString($this->attributes['password_text']);
    // }
    // public function setPasswordTextAttribute($value)
    // {
    //     $this->attributes['password_text'] = Crypt::encryptString($value);
    // }
}
