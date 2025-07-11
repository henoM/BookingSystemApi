<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('resources', App\Http\Controllers\Api\ResourceController::class)->only(['index', 'store']);
Route::get('resources/{id}/bookings', [App\Http\Controllers\Api\ResourceController::class, 'bookings']);
Route::post('bookings', [App\Http\Controllers\Api\BookingController::class, 'store']);
Route::delete('bookings/{id}', [App\Http\Controllers\Api\BookingController::class, 'destroy']);
