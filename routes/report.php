<?php
use Illuminate\Support\Facades\Route;

Route::prefix('report')->middleware('AdminAuth')->group(function () {
  Route::get('/info', ['App\Http\Controllers\Report\User', 'getInfo']);
});
