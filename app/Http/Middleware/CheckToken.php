<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckToken
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
   * @return \Illuminate\Http\JsonResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $validator = Validator::make($request->all(), [
      'token' => 'required|string|max:64|min:64'
    ]);

    if($validator->fails()) {
      return response()->json($request->token, 400);
    }

    $user = User::where('token', $request->token)->first();

    if($user) {
      $request->user = $user;
    } else {
      return response()->json('user is not defined', 400);
    }

    return $next($request);
  }
}
