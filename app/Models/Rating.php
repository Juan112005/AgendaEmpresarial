<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment',   // Coincide con la columna 'assessment' en tu base de datos
        'review',       // Coincide con la columna 'review' en tu base de datos
        'created_at',   // Coincide con la columna 'created_at' en tu base de datos
        'updated_at',   // Coincide con la columna 'updated_at' en tu base de datos
        'users_id',     // Coincide con la columna 'users_id' en tu base de datos
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // Cambiado de 'user_id' a 'users_id'
    }

    // Resto de tu modelo...
}

