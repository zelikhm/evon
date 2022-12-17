<?php

namespace App\Http\Middleware;

use App\Models\User\SessionModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    $hasSession = SessionModel::where('user_id', Auth::id())->where('session', $request->cookie('session_key'))->first();

    if ($hasSession === null) {
      Auth::logout();
      return \redirect('/');
    }

    return $next($request);
  }
}
