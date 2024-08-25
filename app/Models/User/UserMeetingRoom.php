<?php

namespace App\Models\User;

use App\Transformers\User\UserMeetingRoomTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeetingRoom extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $modal =  '#room-modal';
    public $transformer = UserMeetingRoomTransformer::class;
}
