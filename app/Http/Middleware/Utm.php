<?php

namespace App\Http\Middleware;

use App\Models\Log\UtmStat;
use Closure;
use Illuminate\Http\Request;

class Utm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->custom_utm_code) {
          $utm = \App\Models\Log\Utm::where('utm_code', $request->custom_utm_code)
            ->first();

          if($utm) {
            try {
              UtmStat::create([
                'ip' => $request->ip(),
                'utm_id' => $utm->id,
              ]);
            } catch (\Exception $exception) {
              return $next($request);
            }
          }
        }

        return $next($request);
    }
}
