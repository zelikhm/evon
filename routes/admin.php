<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/house')->group(function () {
  Route::get('/success', ['App\Http\Controllers\AdminController', 'success']);
  Route::get('/failed', ['App\Http\Controllers\AdminController', 'failed']);
});
