<?php

use App\Models\Builder\HouseModel;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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
//  dd(\Illuminate\Support\Facades\Auth::user());
  return Inertia::render('AppMain');
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
  Route::get('/chats', ['App\Http\Controllers\User\ChatController', 'getChats'])->name('chats');
  Route::get('/chat/{id}', ['App\Http\Controllers\User\ChatController', 'getChat']);

});

Route::prefix('/compilation')->group(function () {
  Route::get('/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'house']);
});

Route::middleware('auth', 'session')->group(function () {
  Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index']);
  Route::get('/villages', ['App\Http\Controllers\House\HouseController', 'villages']);
  Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
});

Route::get('/404', function () {
  return Inertia::render('AppError');
});

Route::get('test', function () {

  $count = HouseModel::where('visible', 1)
    ->where('active', 2)
    ->join('house_characteristics_models', 'house_characteristics_models.house_id', 'house_models.id')
    ->select('house_models.*')
    ->where('house_characteristics_models.type', 'Новостройка')
    ->count();

  dd($count);
});

Route::get('testSMS', ['App\Http\Controllers\User\AuthController', 'test']);
Route::post('mail', ['App\Http\Controllers\User\IndexController', 'sendRegister'])->name('mail');

Route::get('/privacy', ['App\Http\Controllers\PrivacyController', 'index']);
Route::get('/agree', ['App\Http\Controllers\PrivacyController', 'agree']);

require __DIR__ . '/auth.php';
