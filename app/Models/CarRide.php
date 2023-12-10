<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRide extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'phone',
        'ride_time',
        'strictly_on_time',
        'price',
        'address_to_address',
        'free_seat',
        'state',
    ];

    protected $casts = [
        'free_seat' => 'integer',
        'price' => 'integer',
        'strictly_on_time' => 'boolean',
        'address_to_address' => 'boolean',
    ];


    protected $with = [
        'car',
        'cities',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class)->with('fuel');
    }

    public function cities()
    {
        return $this->hasMany(CarRideCity::class)->with('district');
    }
}
