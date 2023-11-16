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
        'start_city',
        'end_city',
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
    ];


    protected $with = [
        'car',
        'start',
        'end',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function start()
    {
        return $this->belongsTo(District::class, 'start_city' ,'id')->with('region');
    }

    public function end()
    {
        return $this->belongsTo(District::class, 'end_city' ,'id')->with('region');
    }



}
