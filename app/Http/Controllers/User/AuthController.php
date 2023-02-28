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

    $user = User::where('email', $request->email)->first();

    if($user === null) {
      return response()->json(['status' => false, 'code' => 0], 200);
    }

    $rand = rand(100000, 999999);

    User::where('email', $request->email)->update(['code' => $rand]);

    $curl = curl_init();

    $message = "<html><head></head><body><p>
                Code: $rand<br>
                </p></body></html>";

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.smtp.bz/v1/smtp/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
        "authorization: AwFGFIPriK4AQad1rFXt9ox1c00PT8LjugQ1"
      ),
      CURLOPT_POSTFIELDS => http_build_query(array(
        'subject' => "Проверочный код", // Обязательно
        'name' => "Evon",
        'html' => $message, // Обязательно
        'from' => "info@evon-tr.com", // Обязательно
        'to' => $request->email, // Обязательно
        'headers' => "[{ 'x-tag': 'my_newsletter_ids' }]",
        'text' => "Text version message"
      ))
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return response()->json(['status' => true, 'code' => $rand], 200);

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
