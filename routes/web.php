<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('AppMain', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::prefix('profile')->middleware(['auth', 'session'])->group(function () {
  Route::get('/', ['App\Http\Controllers\User\ProfileController', 'index']);

  Route::middleware('CheckRealtor')->group(function () {
    Route::get('/addedHouse', ['App\Http\Controllers\House\HouseController', 'createHouse']);
    Route::get('/edit/{house}', ['App\Http\Controllers\House\HouseController', 'edit']);
    Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'showHouse']);
    Route::get('/news', ['App\Http\Controllers\House\NewsController', 'index']);
    Route::get('/news/create', ['App\Http\Controllers\House\NewsController', 'createNews']);
    Route::get('/news/edit/{id}', ['App\Http\Controllers\House\NewsController', 'editNews']);
  });

  Route::get('/compilation', ['App\Http\Controllers\User\CompilationController', 'index']);

  Route::get('/favorites', ['App\Http\Controllers\User\FavoriteController', 'index']);
//
  Route::get('/chat', ['App\Http\Controllers\User\ChatController', 'index']);

});
Route::prefix('/compilation')->group(function () {
  Route::get('/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'house']);
});


Route::middleware('auth', 'session')->group(function () {
  Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index']);
  Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
});

Route::get('/404', function () {
  return Inertia::render('AppError');
});

Route::get('test', function () {
  dd(\App\Models\Builder\HouseImagesModel::all());
});

Route::get('/privacy', ['App\Http\Controllers\PrivacyController', 'index']);

require __DIR__.'/auth.php';
