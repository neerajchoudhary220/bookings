<?php

use App\Http\Controllers\api\BookingController;
use Illuminate\Support\Facades\Route;


Route::controller(BookingController::class)->prefix('booking')->group(function(){
    Route::get('/','list');
    Route::post('/add','store');
    Route::delete('/delete/{booking}','delete');
    Route::get('/details/{booking}','details');
    Route::post('/update/{booking}','update');

});