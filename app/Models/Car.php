<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillabe = [
        'user_id',
        'type',
        'number',
        'phone',
        'color',
        'fuel_type',
        'trunk',
    ];
}
