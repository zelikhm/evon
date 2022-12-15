<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

  /**
   * check user email
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

    public function checkUserEmail(Request $request) {
      if($request->token === env('TOKEN')) {
        $user = User::where('email', $request->email)->where('role', 1)->first();

        if($user !== null) {
          return response()->json(true, 200);
        } else {
          return response()->json('this user is not find', 404);
        }
      } else {
        return response()->json('not auth', 401);
      }
    }

  /**
   * checkUserPhone
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

    public function checkUserPhone(Request $request) {
      if($request->token === env('TOKEN')) {
        $user = User::where('phone', 'LIKE', '%' . $request->phone . '%')->where('role', 0)->first();

        if($user !== null) {
          return response()->json($this->sendCode($user), 200);
        } else {
          return response()->json('this user is not find', 404);
        }
      } else {
        return response()->json('not auth', 401);
      }
    }

    protected function sendCode($user) {
      $rand = rand(1000, 10000);

      $user->code = $rand;
      $user->save();

      return $rand;
    }
}
