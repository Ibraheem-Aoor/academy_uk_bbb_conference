<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Jobs\SendEmailVerficationNotificationJob;
use App\Transformers\Admin\UserTransformer;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public $modal =  '#user-modal';
    public $transformer = UserTransformer::class;

    public function plan():BelongsTo
    {
        return $this->belongsTo(Plan::class , 'plan_id');
    }
}
