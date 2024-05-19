<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\Password;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Testing\Concerns\Has;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create()
  {
    return redirect('/');
  }

  /**
   * Handle an incoming authentication request.
   *
   * @param \App\Http\Requests\Auth\LoginRequest $request
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {
      $request->validate([
        'password' => ['required', new Password()],
        'email' => ['required', 'max:50', 'exists:App\Models\User,email'],
      ]);

      $user = User::where('email', $request->email)
        ->first();

      if($user !== null && Hash::check($request->password, $user->password) && $user->deleted !== 1) {

        Auth::logoutOtherDevices(Hash::make($request->password));

        $this->checkSession($user->id);

        Auth::login($user, $remember = true);

        if(Auth::user()->role === 3) {

          return redirect()->intended(RouteServiceProvider::ADMIN);

        } elseif (Auth::user()->role === 0) {

          if(Auth::user()->checked === 1) {

            User::where('id', Auth::id())->update([
              'checked' => 0,
            ]);

            return redirect()->intended(RouteServiceProvider::HOME);

          } else {

            return redirect()->intended(RouteServiceProvider::HOUSES);

          }

        } else {

          return redirect()->intended(RouteServiceProvider::HOME);

        }

      }

  }

  /**
   * auth with help phone
   * @param Request $request
   * @return bool|\Illuminate\Http\RedirectResponse
   */

  public function storePhone(Request $request) {

    $request->validate([
      'email' => ['required', 'max:50', 'exists:App\Models\User,email'],
    ]);

    $user = User::where('email', 'LIKE', '%' . $request->email . '%')
      ->where('role', 0)
      ->first();

    if($user !== null && $user->code == $request->code && $user->deleted !== 1) {

      Auth::logoutOtherDevices(Hash::make($request->password));

      $this->checkSession($user->id);

      Auth::login($user, $remember = true);

      if(Auth::user()->checked === 1) {

        User::where('id', Auth::id())->update([
          'checked' => 0,
        ]);

        return redirect()->intended(RouteServiceProvider::HOME);

      } else {

        return redirect()->intended(RouteServiceProvider::HOUSES);

      }

    } else {
      return false;
    }
  }

  /**
   * login api
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function loginApi(Request $request) {

    $request->validate([
      'email' => ['required', 'max:50', 'exists:App\Models\User,email'],
      'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)
      ->first();

    if($user !== null && Hash::check($request->password, $user->password) && $user->deleted !== 1) {

      $token = $this->checkSession($user->id);

      if($user->deleted !== 1) {
        return response()->json($token, 200);
      } else {
        return response()->json(false, 205);
      }

    } else {

      if($user === null) {
        return response()->json('Не правильный логин или емеил', 401);
      }

      if(!Hash::check($request->password, $user->password)) {
        return response()->json('Не правильный пароль', 401);
      }

    }

  }

  /**
   * login rieltor with help api
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function loginApiSms(Request $request) {

    $user = User::where('email', $request->email)
      ->where('code', $request->code)
      ->first();

    if($user !== null && $user->deleted !== 1) {

      $token = $this->checkSession($user->id);

      if($user->deleted !== 1) {
        return response()->json($token, 200);
      } else {
        return response()->json(false, 205);
      }

    } else {
      return response()->json(false, 401);
    }

  }

  /**
   * check auth user and delete session for other device
   * @param $id
   */

  protected function checkSession($id) {
    $session = User\Session::where('user_id', $id)->get();

    if(count($session) !== 0) {
      User\Session::where('user_id', $id)->delete();
    }

    return $this->setSession($id);
  }

  /**
   * set session on the yourself device
   * @param $id
   */

  protected function setSession($id) {

    $session = rand(10000, 100000);

    Cookie::queue('session_key', $session, 262800);

    User\Session::create([
      'session' => $session,
      'user_id' => $id,
      'active' => 1,
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

    return $this->setToken($id);

  }

  /**
   * set jwt token for user
   * @param $id
   */

  protected function setToken($id) {

    $str = rand();
    $token = hash("sha256", $str);

    User::where('id', $id)->update([
      'token' => $token,
    ]);

    return $token;

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
