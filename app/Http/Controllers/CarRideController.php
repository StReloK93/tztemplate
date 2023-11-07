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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return CarRide::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CarRide $carRide)
    {
        //
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
