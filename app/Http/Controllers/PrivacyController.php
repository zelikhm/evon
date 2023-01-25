<?php

namespace App\Http\Controllers;

use App\Http\Traits\MainInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PrivacyController extends Controller
{
  use MainInfo;

    public function index() {

      return Inertia::render('AppPrivacyPolicy', [
        'user' => $this->getUser(),
        'notification' => $this->getNotification(),
      ]);

    }

    public function agree() {
      return Inertia::render('AppUserAgree', [
        'user' => $this->getUser(),
        'notification' => $this->getNotification(),
      ]);
    }
}
