<?php

namespace App\Models\BaseModels;

use App\Models\User;
use App\Observers\UserMeetingObserver;
use App\Transformers\Admin\MeetingTransformer;
use App\Transformers\User\UserMeetingTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

abstract class BaseMeetingParticipantModel extends Model
{
    use HasFactory, Notifiable;

    public $meeting_model;

    protected static function booted()
    {
        static::created(function ($model) {
            $model->update([
                'bridge_url' => $model->generateBridgeUrlForParticipant(),
            ]);
        });
        static::updated(function ($model) {
            $model->withoutEvents(function () use ($model) {
                $model->update([
                    'bridge_url' => $model->generateBridgeUrlForParticipant(),
                ]);
            });
        });
    }

    abstract public function generateBridgeUrlForParticipant();


}
