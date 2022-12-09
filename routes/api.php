<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('house')->group(function () {
  Route::post('create', ['App\Http\Controllers\House\HouseController', 'create']);
  Route::post('addedSupport', ['App\Http\Controllers\House\HouseController', 'supports']);
  Route::post('get', ['App\Http\Controllers\House\HouseController', 'get']);
  Route::post('createFrame', ['App\Http\Controllers\House\HouseController', 'createFrame']);
  Route::post('createFlat', ['App\Http\Controllers\House\HouseController', 'createFlat']);
});

Route::prefix('news')->group(function () {
  Route::post('add', ['App\Http\Controllers\House\NewsController', 'add']);
  Route::post('edit', ['App\Http\Controllers\House\NewsController', 'edit']);
  Route::post('delete', ['App\Http\Controllers\House\NewsController', 'delete']);
  Route::post('visible', ['App\Http\Controllers\House\NewsController', 'visible']);
});
