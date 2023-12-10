<?php

namespace App\Http\Controllers;

use App\Models\CarRide;
use App\Models\CarRideCity;
use Illuminate\Http\Request;
use App\Events\CarRideCreateEvent;
class CarRideController extends Controller
{
    public function index()
    {
        return CarRide::whereState(1)->get();
    }

    public function store(Request $request)
    {
        $carRide = CarRide::create([
            'car_id' => $request->car_id,
            'phone' => $request->phone,
            'ride_time' => $request->ride_time,
            'strictly_on_time' => $request->strictly_on_time,
            'price' => $request->price,
            'free_seat' => $request->free_seat,
            'address_to_address' => $request->address_to_address,
            'state' => true,
        ]);

        

        foreach ($request->ends as $key => $item) {
            CarRideCity::create([
                'car_ride_id' => $carRide->id,
                'district_id' => $item['city']
            ]);
        }

        $carRide = $carRide->fresh();
        broadcast(new CarRideCreateEvent($carRide))->toOthers();
        return $carRide;
    }

    public function show(CarRide $carRide)
    {
        return $carRide;
    }

    public function update(Request $request, CarRide $carRide)
    {
        $carRide->car_id = $request->car_id;
        $carRide->phone = $request->phone;
        $carRide->ride_time = $request->ride_time;
        $carRide->strictly_on_time = $request->strictly_on_time;
        $carRide->price = $request->price;
        $carRide->free_seat = $request->free_seat;
        $carRide->address_to_address = $request->address_to_address;
        $carRide->save();
        
        
        return $carRide->fresh();
    }

    public function destroy(CarRide $carRide)
    {
        $carRide->state = 0;
        $carRide->save();

        return $carRide->fresh();
    }
}
