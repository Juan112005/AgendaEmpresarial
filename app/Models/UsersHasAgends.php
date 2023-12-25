<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersHasAgends extends Model
{
    use HasFactory;
    protected $fillable = [
        'agends_id',
        'users_id',
    ];
    public $timestamps = false;

}
