<?php

use App\Models\Builder\HouseModel;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Traits\MainInfo;

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

Route::get('/', ['App\Http\Controllers\Controller', 'main']);

Route::get('/test', function () {
  $houses = HouseModel::where('visible', 1)
    ->orderBy('updated_at', 'DESC')
    ->where('active', 2)
    ->join('house_characteristics_models', 'house_characteristics_models.house_id', 'house_models.id')
    ->select('house_models.*')
    ->where('house_characteristics_models.type', 'Новостройка')
    ->distinct()
    ->with(['info', 'files', 'frames', 'flats', 'user', 'news', 'images'])
    ->get();

  $i = 0;
  $array = collect();

  foreach ($houses as $house) {
    foreach ($house->flats as $flat) {
      if($flat->price >= 290000 && $flat->price <= 291000) {
        $i++;
        $array->push($house);
        continue;
      }
    }
  }

  dd($array->unique('id'));
});

Route::post('/mail', ['App\Http\Controllers\User\IndexController', 'sendRegister'])->name('mail');

Route::prefix('profile')->middleware(['auth', 'session'])->group(function () {
  Route::get('/', ['App\Http\Controllers\User\ProfileController', 'index']);

  Route::middleware('CheckSubscription')->group(function () {
    Route::middleware('CheckRealtor')->group(function () {
    Route::get('/addedHouse', ['App\Http\Controllers\House\HouseController', 'createHouse']);
    Route::get('/edit/{house}', ['App\Http\Controllers\House\HouseController', 'edit']);
    Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'showHouse']);
    Route::get('/news', ['App\Http\Controllers\House\NewsController', 'index']);
    Route::get('/news/create', ['App\Http\Controllers\House\NewsController', 'createNews']);
    Route::get('/news/edit/{id}', ['App\Http\Controllers\House\NewsController', 'editNews']);
  });
    Route::get('/help', ['App\Http\Controllers\HelpController', 'getHelp']);
    Route::get('/compilation', ['App\Http\Controllers\User\CompilationController', 'index']);
    Route::get('/favorites', ['App\Http\Controllers\User\FavoriteController', 'index']);
    Route::get('/chat', ['App\Http\Controllers\User\ChatController', 'index']);
    Route::get('/chats', ['App\Http\Controllers\User\ChatController', 'getChats'])->name('chats');
    Route::get('/chat/{id}', ['App\Http\Controllers\User\ChatController', 'getChat']);
  });
});

Route::prefix('/compilation')->group(function () {
  Route::get('/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/user/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'soloHouse']);
  Route::get('/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'house']);
});

Route::prefix('/house')->group(function () {
  Route::get('/success', ['App\Http\Controllers\AdminController', 'success']);
  Route::get('/failed', ['App\Http\Controllers\AdminController', 'failed']);
});

Route::middleware('auth', 'session', 'CheckSubscription')->group(function () {
  Route::middleware('CheckBuilder')->group(function () {
    Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index']);
    Route::get('/villages', ['App\Http\Controllers\House\HouseController', 'villages']);
  });
  Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
});

Route::get('/404', function () {
  return Inertia::render('AppError');
});

Route::get('/privacy', ['App\Http\Controllers\PrivacyController', 'index']);
Route::get('/agree', ['App\Http\Controllers\PrivacyController', 'agree']);

Route::prefix('cloud')->group(function () {
  Route::post('payment', ['App\Http\Controllers\Payment\IndexController', 'cloud']);
  Route::post('failed', ['App\Http\Controllers\Payment\IndexController', 'setFailed']);
});

require __DIR__ . '/auth.php';
