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

Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index'])->middleware(['auth']);
Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);

Route::prefix('profile')->middleware(['auth', 'session'])->group(function () {
  Route::get('/', ['App\Http\Controllers\User\ProfileController', 'index']);
  Route::get('/compilation', ['App\Http\Controllers\User\CompilationController', 'index']);
  Route::get('/compilation/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/compilation/{id}/edit', ['App\Http\Controllers\User\CompilationController', 'edit']);
  Route::get('/addedHouse', ['App\Http\Controllers\House\HouseController', 'createHouse']);
  Route::get('/edit/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
  Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'showHouse']);
  Route::get('/news', ['App\Http\Controllers\House\NewsController', 'index']);
});

Route::get('/privacy', ['App\Http\Controllers\PrivacyController', 'index']);

Route::prefix('messages')->group(function () {
  Route::get('/');
  Route::get('/{id}');
})->middleware('auth');

require __DIR__.'/auth.php';
