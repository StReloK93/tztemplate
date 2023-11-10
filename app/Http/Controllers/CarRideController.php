<?php

namespace App\Http\Controllers;

use App\Models\CarRide;
use Illuminate\Http\Request;

class CarRideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarRide::with(['start', 'car', 'end'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return CarRide::create([
            'car_id' => $request->car,
            'start_city' => $request->start_city,
            'end_city' => $request->end_city,
            'ride_time' => $request->ride_time,
            'strictly_on_time' => $request->strictly_on_time,
            'price' => $request->price,
            'free_seat' => $request->free_seat,
            'address_to_address' => $request->address_to_address,
            'state' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarRide $carRide)
    {
        return $carRide;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarRide $carRide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarRide $carRide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarRide $carRide)
    {
        //
    }
}
