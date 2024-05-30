<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Jobs\SendEmailVerficationNotificationJob;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class User extends Authenticatable implements MustVerifyEmailContract
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

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        SendEmailVerficationNotificationJob::dispatch($this);
    }

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class, 'user_id', 'id');
    }

    public function webshopAccounts(): HasMany
    {
        return $this->hasMany(UserWebShopAccount::class, 'user_id', 'id');
    }


    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(Order::class, UserWebShopAccount::class, 'user_id', 'user_web_shop_account_id', 'id', 'id');
    }

    public function shippingContract(): HasMany
    {
        return $this->hasMany(UserShippingContract::class, 'user_id', 'id');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, UserWebShopAccount::class, 'user_id', 'user_web_shop_account_id', 'id', 'id');
    }
}
