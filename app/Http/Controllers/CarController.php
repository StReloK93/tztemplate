<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::with(['user', 'fuel'])->get();
    }


    public function store(Request $request)
    {
        $car = Car::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'number' => $request->number,
            'color' => $request->color,
            'fuel_type' => $request->fuel_type,
            'trunk' => $request->trunk,
        ]);
        $car->fuel;
        $car->user;
        return $car;
    }


    public function show(Car $car)
    {
        return $car;
    }


    public function update(Request $request, Car $car)
    {
        $car->user_id = $request->user_id;
        $car->type = $request->type;
        $car->number = $request->number;
        $car->color = $request->color;
        $car->fuel_type = $request->fuel_type;
        $car->trunk = $request->trunk;

        $car->save();
        $car->fuel;
        $car->user;
        return $car;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
