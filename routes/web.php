<?php

use App\Models\Builder\House;
use App\Models\User;
use App\Services\Image\ImageService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Traits\MainInfo;
use Intervention\Image\Facades\Image;

Route::get('/', ['App\Http\Controllers\Controller', 'main'])->middleware('utm');

Route::get('/test', function () {
  House::updated([
    'active' => 1,
  ]);

  House::updated([
    'active' => 2
  ]);
});

Route::prefix('/compilation')->group(function () {
  Route::get('/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/user/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'soloHouse']);
  Route::get('/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'house']);

  Route::prefix('builder')->group(function () {
    Route::get('/compilation/{slug}', ['App\Http\Controllers\User\BuilderCompilationController', 'compilation']);
    Route::post('/getLink', ['App\Http\Controllers\User\BuilderCompilationController', 'getLink']);
  });
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
require __DIR__ . '/form.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/agentRoutes.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/report.php';

