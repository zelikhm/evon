<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
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
   * @return \Illuminate\Http\JsonResponse
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(LoginRequest $request)
  {
    if($request->token === env('TOKEN')) {
      $user = User::where('email', $request->email)
        ->first();

      if($user === null) {
        $user_phone = User::where('phone', $request->phone)
          ->first();

        if($user_phone !== null) {
          Auth::login($user_phone, $remember = true);

          $this->checkSession($user_phone->id);

        } else {
          return response()->json('not auth', 401);
        }
      }

      if($user !== null && Hash::check($request->password, $user->password)) {
        Auth::logoutOtherDevices(Hash::make($request->password));

        $this->checkSession($user->id);

        Auth::login($user, $remember = true);

        return redirect()->intended(RouteServiceProvider::HOME);
      } else {
        return response()->json('not auth', 401);
      }
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * check auth user and delete session for other device
   * @param $id
   */

  protected function checkSession($id) {
    $session = User\SessionModel::where('user_id', $id)->get();

    if(count($session) !== 0) {
      User\SessionModel::where('user_id', $id)->delete();
    }

    $this->setSession($id);
  }

  /**
   * set session on the yourself device
   * @param $id
   */

  protected function setSession($id) {

    User\SessionModel::create([
      'session' => rand(10000, 100000),
      'user_id' => $id,
      'active' => 1,
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

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
