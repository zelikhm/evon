<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionCheckUser
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, $guard = null)
  {
//    if (!auth()->check()) {
//      return $next($request);
//    }
//
//    $user = Auth::user();
//
//    if ($user->logout === false) {
//      $user->update(['logout' => true]);
//      Auth::logout();
//
//      return redirect()->route('login');
//    }

    return $next($request);
  }
}
