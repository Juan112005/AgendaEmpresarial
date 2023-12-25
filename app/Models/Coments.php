<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coments extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'users_id',
        'events_id',
        'statuses_id',
    ];
}

