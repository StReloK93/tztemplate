<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_ride_id',
        'district_id',
    ];
}
