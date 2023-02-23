<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
  use AuthCheck;

  /**
   * check user email
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function checkUserEmail(Request $request)
  {
    if ($this->checkToken($request->token)) {
      $user = User::where('email', $request->email)->where('role', 1)->first();

      if ($user !== null) {
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

  public function checkUserPhone(Request $request)
  {
    if ($this->checkToken($request->token)) {
      $user = User::where('phone', 'LIKE', '%' . $request->phone . '%')->where('role', 0)->first();

      if ($user !== null) {
        return response()->json($this->sendCode($user), 200);
      } else {
        return response()->json('this user is not find', 404);
      }
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * send code
   * @return \Illuminate\Http\JsonResponse
   */

  public function sendCode(Request $request)
  {
    $rand = rand(1000, 9999);

    Http::withBasicAuth('Evon903', 'Evon904')->get(
      'http://api.smsfeedback.ru/messages/v2/send/?phone=' . $request->phone
      . '&text=' . 'Проверочный код: ' . $rand
      . '&sender=EVON'
    );

    $user = User::where('phone', 'LIKE', '%' . $request->phone)
      ->where('role', 0)
      ->first();

    if($user !== null) {
      User::where('phone', $request->phone)
        ->update(['code' => $rand]);

      return response()->json($rand, 200);
    } else {
      return response()->json(false, 400);
    }


  }
}
