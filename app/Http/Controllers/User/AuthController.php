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

  public function test(Request $request) {
//
//    $response = Http::withBasicAuth('Evon903', 'Evon904')->get('http://api.smsfeedback.ru/messages/v2/status/?id=6252550514');
//    dd($response);
//

    dd($this->send("api.smsfeedback.ru", 443, "Evon903", "Evon904",
      "79086761887", "От этого апи пахнет гавной", "TEST-SMS"));

  }

  public function send($host, $port, $login, $password, $phone, $text, $sender = false, $wapurl = false )
  {
    $fp = fsockopen('ssl://'.$host, $port, $errno, $errstr);

    if (!$fp) {
      return "errno: $errno \nerrstr: $errstr\n";
    }
    fwrite($fp, "GET /messages/v2/send/" .
      "?phone=" . rawurlencode($phone) .
      "&text=" . rawurlencode($text) .
      ($sender ? "&sender=" . rawurlencode($sender) : "") .
      ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") .
      " HTTP/1.0\r\n");
    fwrite($fp, "Host: " . $host . "\r\n");
    if ($login != "") {
      fwrite($fp, "Authorization: Basic " .
        base64_encode($login. ":" . $password) . "\n");
    }
    fwrite($fp, "\n");
    $response = "";
    while(!feof($fp)) {
      $response .= fread($fp, 1);
    }
    fclose($fp);
    list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
    return $responseBody;
  }
}
