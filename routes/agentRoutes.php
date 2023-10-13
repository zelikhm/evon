<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'session', 'CheckVerification')->group(function () {
  Route::middleware('CheckBuilder')->group(function () {
    Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index']);
    Route::get('/villages', ['App\Http\Controllers\House\HouseController', 'villages']);
  });
  Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
});
