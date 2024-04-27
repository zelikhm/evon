<?php

namespace App\Http\Middleware;

use App\Models\User\Session;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SessionCheckUser
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function handle(Request $request, Closure $next, $guard = null)
  {
    $hasSession = Session::where('user_id', Auth::id())
      ->where('session', $request->cookie('session_key'))
      ->first();

    if ($hasSession === null) {
      if(Auth::user()->role < 2) {
        Auth::logout();
      }

      return Inertia::location('/');
    }

    return $next($request);
  }
}
