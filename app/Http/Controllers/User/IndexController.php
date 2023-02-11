<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseSupportModel;
use App\Models\User;
use App\Rules\Password;
use Illuminate\Http\Request;

class IndexController extends Controller
{

  use AuthCheck;

  /**
   * get user
   * @param Request $request
   * @return mixed
   */

  public function get(Request $request)
  {
    if ($this->checkToken($request->token)) {

      return User::where('token', $request->token)
        ->with(['company'])
        ->first();

    } else {

      return response()->json('not auth', 401);

    }
  }

  /**
   * edit user
   * @param Request $request
   */

  public function edit(Request $request)
  {
    if ($this->checkToken($request->token)) {

      if($request->image !== 'undefined') {
        $imageName = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('/storage/user'), $imageName);
        $imageName = '/storage/user/' . $imageName;
      } else {
       $user = User::where('id', $request->user_id)->first();
       $imageName = $user->image;
      }

      User::where('id', $request->user_id)->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'status' => $request->status,
        'link' => $request->link,
        'description' => $request->description,
        'email' => $request->email,
        'image' => $imageName,
      ]);

      return response()->json(User::where('id', $request->user_id)->first(), 200);

    } else {

      return response()->json('not auth', 401);

    }
  }

  public function sendRegister(Request $request) {

    $request->validate([
      'first_name' => ['required'],
      'last_name' => ['required'],
      'phone' => ['required'],
      'email' => ['required'],
    ]);

    $curl = curl_init();

    $message = "<html><head></head><body><p>
                Подана заявка на регистрацию<br>
                Имя: . $request->first_name<br>
                Фамилия: . $request->last_name<br>
                Телефон: . $request->phone<br>
                Email: . $request->email<br>
                Место работы: . $request->type<br>
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
        'subject' => "Регистрация нового пользователя", // Обязательно
        'name' => "Evon",
        'html' => $message, // Обязательно
        'from' => "info@evon-tr.com", // Обязательно
        'to' => "evon.information@gmail.com", // Обязательно
        'headers' => "[{ 'x-tag': 'my_newsletter_ids' }]",
        'text' => "Text version message"
      ))
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


  }
}
