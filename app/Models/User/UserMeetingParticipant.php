<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeetingParticipant extends Model
{
    use HasFactory;
    protected $guarded  = ['__token' , 'id'];
}
