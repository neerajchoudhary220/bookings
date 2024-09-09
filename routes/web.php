<?php

use App\Constants\Constants;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/{any}',function (){
    return view('index');
})->where('any',Constants::WEB_ROUTES);


// Route::get('/{any}',function (){
//     return view('index');
// })->where('any','add|edit*');


