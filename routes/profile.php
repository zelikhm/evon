<?php

use Illuminate\Support\Facades\Route;

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

  Route::middleware('CheckVerification', 'CheckBuilder')->group(function () {
    Route::middleware('CheckSubscription')->group(function () {
      Route::get('/compilation', ['App\Http\Controllers\User\CompilationController', 'index']);
    });
    Route::get('/help', ['App\Http\Controllers\HelpController', 'getHelp']);
    Route::get('/favorites', ['App\Http\Controllers\User\FavoriteController', 'index']);
    Route::get('/chat', ['App\Http\Controllers\User\ChatController', 'index']);
    Route::get('/chats', ['App\Http\Controllers\User\ChatController', 'getChats'])->name('chats');
    Route::get('/chat/{id}', ['App\Http\Controllers\User\ChatController', 'getChat']);
  });
});
