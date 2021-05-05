<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 'rents';

    protected $fillable = [
        'user_id',
        'movie_id',
        'start_date',
        'end_date',
        'penalty',
        'total',
        'created_at',
    ];

    protected $hidden = [
        // 'created_at',
        'updated_at',
    ];
}
