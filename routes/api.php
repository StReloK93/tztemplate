<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistrictController;


use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('post', PostController::class);

Route::apiResource('car', CarController::class);
Route::apiResource('region', RegionController::class);
Route::apiResource('district', DistrictController::class);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/logout', [AuthController::class, 'logoutUser']);

});




// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/home');
// })->middleware(['signed','auth:sanctum'])->name('verification.verify');

