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
  Route::post('clearSupport', ['App\Http\Controllers\House\HouseController', 'clearSupport']);
  Route::post('deleteSupport', ['App\Http\Controllers\House\HouseController', 'deleteSupport']);
  Route::post('get', ['App\Http\Controllers\House\HouseController', 'get']);
  Route::post('createFrame', ['App\Http\Controllers\House\HouseController', 'createFrame']);
  Route::post('createFlat', ['App\Http\Controllers\House\HouseController', 'createFlat']);
  Route::post('addedImages', ['App\Http\Controllers\House\HouseController', 'addedImages']);
  Route::post('setVisible', ['App\Http\Controllers\House\HouseController', 'setVisible']);
  Route::post('delete', ['App\Http\Controllers\House\HouseController', 'delete']);
  //
  Route::post('getHouseApi', ['App\Http\Controllers\House\HouseController', 'getHouseApi']);
  Route::get('getHousesApi', ['App\Http\Controllers\House\HouseController', 'getHousesApi']);
});

Route::prefix('compilation')->group(function () {
  Route::post('/addHouse', ['App\Http\Controllers\User\CompilationController', 'addHouse']);
  Route::post('/create', ['App\Http\Controllers\User\CompilationController', 'create']);
  Route::post('/delete', ['App\Http\Controllers\User\CompilationController', 'delete']);
  Route::post('/get', ['App\Http\Controllers\User\CompilationController', 'get']);
  Route::post('/getAll', ['App\Http\Controllers\User\CompilationController', 'getAll']);
});

Route::prefix('notification')->group(function () {
  Route::post('/delete', ['App\Http\Controllers\NotificationController', 'delete']);
  Route::get('/get', ['App\Http\Controllers\NotificationController', 'get']);
});

Route::prefix('favorite')->group(function () {
  Route::post('/add', ['App\Http\Controllers\User\FavoriteController', 'add']);
  Route::get('getAll', ['App\Http\Controllers\User\FavoriteController', 'getAll']);
});

Route::prefix('user')->group(function () {
  Route::post('phone', ['App\Http\Controllers\User\AuthController', 'checkUserPhone']);
  Route::post('email', ['App\Http\Controllers\User\AuthController', 'checkUserEmail']);
  //
  Route::post('get', ['App\Http\Controllers\User\IndexController', 'get']);
  Route::post('edit', ['App\Http\Controllers\User\IndexController', 'edit']);
  Route::post('addedCompany', ['App\Http\Controllers\User\IndexController', 'addedCompany']);
  Route::post('editCompany', ['App\Http\Controllers\User\IndexController', 'editCompany']);
});

Route::prefix('chat')->group(function () {
  Route::post('/message', ['App\Http\Controllers\Messages\MessageController', 'message']);
  Route::post('/reloadChats', ['App\Http\Controllers\Messages\MessageController', 'reloadChats']);
  Route::post('/reloadChat', ['App\Http\Controllers\Messages\MessageController', 'reloadChat']);
});

Route::prefix('news')->group(function () {
  Route::post('add', ['App\Http\Controllers\House\NewsController', 'add']);
  Route::post('edit', ['App\Http\Controllers\House\NewsController', 'edit']);
  Route::post('delete', ['App\Http\Controllers\House\NewsController', 'delete']);
  Route::post('visible', ['App\Http\Controllers\House\NewsController', 'visible']);
  //
  Route::get('getAllNews',['App\Http\Controllers\House\NewsController', 'getAllNews']);
  Route::post('getAllNewsForUser',['App\Http\Controllers\House\NewsController', 'getAllNewsForUser']);
  Route::post('getNew',['App\Http\Controllers\House\NewsController', 'getNew']);
});
