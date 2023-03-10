<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Mail\RegisterEmail;
use App\Models\TarifModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ProfileController extends Controller
{
  use MainInfo;

    public function index() {
//dd($this->getUser());
      if(Auth::user()->role !== 0) {
        return Inertia::render('AppProfileDev', [
          'user' => $this->getUser(),
          'tarifs' => TarifModel::all(),
          'notification' => $this->getNotification(),
        ]);

      } else {

        return Inertia::render('AppProfileAgent', [
          'user' => $this->getUser(),
          'tarifs' => TarifModel::all(),
          'notification' => $this->getNotification(),
        ]);

      }

    }

    public function sendRegister(Request $request) {

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


}
