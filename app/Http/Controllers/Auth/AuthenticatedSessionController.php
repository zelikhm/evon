<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Testing\Concerns\Has;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   *
   * @return \Inertia\Response
   */
  public function create()
  {
    return Inertia::render('Auth/Login', [
      'canResetPassword' => Route::has('password.request'),
      'status' => session('status'),
    ]);
  }

  /**
   * Handle an incoming authentication request.
   *
   * @param \App\Http\Requests\Auth\LoginRequest $request
   * @return \Illuminate\Http\Response
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(LoginRequest $request)
  {
    $user = User::where('email', $request->email)
      ->first();

    if($user === null) {
      $user = User::where('phone', $request->phone)
        ->first();

      if($user !== null) {
        Auth::login($user, $remember = true);
      } else {
        return response()->json('not auth', 401);
      }
    }

    if(Hash::check($request->password, $user->password)) {
      Auth::logoutOtherDevices(Hash::make($request->password));

      Auth::login($user, $remember = true);

      return redirect()->intended(RouteServiceProvider::HOME);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * Destroy an authenticated session.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
