<?php

use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::controller(MovieController::class)->prefix('list')->group(function(){
Route::get('/','list');
});


Route::controller(BookingController::class)->prefix('booking')->group(function(){
    Route::get('/','list');
    Route::post('/add','store');
    Route::delete('/delete/{booking}','delete');
    Route::get('/details/{booking}','details');
    Route::post('/update/{booking}','update');

});