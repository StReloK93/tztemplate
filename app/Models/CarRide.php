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
        'start',
        'ends',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class)->with('fuel');
    }

    public function start()
    {
        return $this->belongsTo(District::class, 'start_city' ,'id')->with('region');
    }


    public function ends()
    {
        return $this->hasMany(EndCity::class);
    }
}
