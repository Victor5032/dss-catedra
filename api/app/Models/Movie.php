<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'poster',
        'rent_price',
        'sale_price',
        'stock',
        'status'
    ];

    protected $hidden = [
        // 'status',
        'created_at',
        'updated_at',
    ];
}
