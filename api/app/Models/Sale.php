<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'user_id',
        'movie_id',
        'total',
        'created_at',
    ];

    protected $hidden = [
        // 'created_at',
        'updated_at',
    ];
}
