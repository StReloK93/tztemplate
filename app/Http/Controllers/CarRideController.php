<?php

namespace App\Http\Controllers;

use App\Models\CarRide;
use Illuminate\Http\Request;
use App\Events\NewEvent;
class CarRideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarRide::with(['start', 'car', 'end'])->whereState(1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carRide = CarRide::create([
            'car_id' => $request->car_id,
            'phone' => $request->phone,
            'start_city' => $request->start_city,
            'end_city' => $request->end_city,
            'ride_time' => $request->ride_time,
            'strictly_on_time' => $request->strictly_on_time,
            'price' => $request->price,
            'free_seat' => $request->free_seat,
            'address_to_address' => $request->address_to_address,
            'state' => true,
        ]);
        event(new NewEvent($carRide));
        return $carRide->fresh();
    }

    /**
     * Display the specified resource.
     */
    public function show(CarRide $carRide)
    {
        return $carRide;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarRide $carRide)
    {
        $carRide->car_id = $request->car_id;
        $carRide->phone = $request->phone;
        $carRide->start_city = $request->start_city;
        $carRide->end_city = $request->end_city;
        $carRide->ride_time = $request->ride_time;
        $carRide->strictly_on_time = $request->strictly_on_time;
        $carRide->price = $request->price;
        $carRide->free_seat = $request->free_seat;
        $carRide->address_to_address = $request->address_to_address;
        $carRide->save();
        
        return $carRide->fresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarRide $carRide)
    {
        $carRide->state = 0;
        $carRide->save();

        return $carRide->fresh();
    }
}
