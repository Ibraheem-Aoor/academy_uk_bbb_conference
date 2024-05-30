<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\Admin\MeetingTransformer;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;

    public $transformer = MeetingTransformer::class;
    public $modal = '#meeting-modal';

    protected $guarded = ['id', '_token'];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class , 'meeting_id');
    }
}
