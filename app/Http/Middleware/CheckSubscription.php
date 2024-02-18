<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckSubscription
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

//      if(Auth::user()->role === 0) {
//        $subscription = Auth::user()->subscription()->first();
//
//        if($subscription === null) {
//          if(Auth::user()->free_subscription === 1) {
//            return Inertia::location('/profile?subscription=1');
//          } else {
//            return Inertia::location('/profile?subscription=0');
//          }
//        } else {
//          if($subscription->finished_at > Carbon::now()) {
            return $next($request);
//          } else {
//            return Inertia::location('/profile?subscription=0');
//          }
//        }
//      }

    } //end
}
