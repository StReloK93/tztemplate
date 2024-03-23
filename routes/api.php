<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CarRideController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PassengerController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/sendSecretCode', [AuthController::class, 'sendSecretCode']);
Route::apiResource('post', PostController::class);

Route::apiResource('car', CarController::class);
Route::apiResource('region', RegionController::class);
Route::apiResource('district', DistrictController::class);
Route::apiResource('passenger', PassengerController::class);
Route::apiResource('car-ride', CarRideController::class);
Route::apiResource('fuel_type', FuelTypeController::class)->only(['index']);
Route::apiResource('users', UserController::class)->only(['index']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/logout', [AuthController::class, 'logoutUser']);

});