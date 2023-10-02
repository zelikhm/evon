<?php
use Illuminate\Support\Facades\Route;

Route::post('/verification', ['App\Http\Controllers\User\VerificationController', 'send']);

Route::post('/register', ['App\Http\Controllers\User\IndexController', 'sendRegister'])
  ->name('register');
