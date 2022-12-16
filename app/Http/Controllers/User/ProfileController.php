<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
  use MainInfo;

    public function index() {

      return Inertia::render('AppProfileDev', [
        'user' => Auth::user(),
        'notification' => $this->getNotification(),
      ]);

    }
}
