<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllRecording extends Model
{
    use HasFactory;
    protected $guarded = ['id'  , '__token'];
}
