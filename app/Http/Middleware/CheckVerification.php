<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\User\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckVerification
{

  /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {

      $user = User::where('id', Auth::id())
        ->with(['company', 'subscriptionInfo', 'verification'])
        ->first();

        if($user->verification !== null && $user->verification->isVerification === 2) {
          return $next($request);
        } else {
          return Inertia::location('/profile?verification=-1');
        }
    } //end
}
