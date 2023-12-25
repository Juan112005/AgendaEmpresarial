<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'ubication',
        'fech_inicio',
        'fech_final',
        'updated_at', 
        'created_at',
        'agends_id',
        'priorities_id',
        'statuses_id',
    ];
}
