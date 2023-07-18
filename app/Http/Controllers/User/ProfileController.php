<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Mail\RegisterEmail;
use App\Models\TarifModel;
use App\Models\TarifRussionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ProfileController extends Controller
{
  use MainInfo;
  use AuthCheck;

  /**
   * profile controller
   * @return \Inertia\Response
   */

  public function index()
  {

    if (Auth::user()->role !== 0) {
      return Inertia::render('AppProfileDev', [
        'user' => $this->getUser(),
        'tarifs' => TarifModel::all(),
        'tarifs_rus' => TarifRussionModel::all(),
        'notification' => $this->getNotification(),
      ]);

    } else {

      return Inertia::render('AppProfileAgent', [
        'user' => $this->getUser(),
        'tarifs' => TarifModel::all(),
        'tarifs_rus' => TarifRussionModel::all(),
        'notification' => $this->getNotification(),
      ]);

    }

  }

  /**
   * send register
   * @param Request $request
   */

  public function sendRegister(Request $request)
  {

    $key = 'AwFGFIPriK4AQad1rFXt9ox1c00PT8LjugQ1';

    $client = Http::withHeaders([
      'Authorization' => $key
    ])->post('https://api.smtp.bz/v1/smtp/send', [
      'subject' => "Register", // Обязательно
      'name' => "Nikita Zel",
      'html' => "<html><head></head><body><p>My text</p></body></html>", // Обязательно
      'from' => "evon.information@gmail.com", // Обязательно
      'to' => "boss.Zelikov99@gmail.com", // Обязательно
      'headers' => "[{ 'x-tag': 'my_newsletter_ids' }]",
      'text' => "Text version message"
    ]);

//      $client = Http::withHeaders([
//      'Authorization' => $key
//    ])->get('https://api.smtp.bz/v1/user');

    dd(json_decode($client));

  }

  /**
   * delete account
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deleteAccount(Request $request) {

    if($this->checkToken($request->token)) {

      User::where('id', $request->user_id)
        ->update([
          'deleted' => 1,
        ]);

      return response()->json(true, 200);

    } else {

      return response()->json(false, 401);

    }

  }


}
