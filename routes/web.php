<?php

use App\Http\Controllers\ProfileController;
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


//Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index'])->middleware(['auth']);
//Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);

Route::prefix('profile')->middleware(['auth'])->group(function () {
  Route::get('/addedHouse', ['App\Http\Controllers\House\HouseController', 'createHouse']);
  Route::get('/edit/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
  Route::get('/compilation', ['App\Http\Controllers\User\CompilationController', 'index']);
  Route::get('/compilation/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/compilation/{id}/edit', ['App\Http\Controllers\User\CompilationController', 'edit']);
});

Route::prefix('messages')->group(function () {
  Route::get('/');
  Route::get('/{id}');
})->middleware('auth');

Route::get('/test', function () {
//  dd(env('TOKEN'));
  $user = User::where('phone', '+375295109994')->where('role', 0)->first();
  dd($user);
});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
