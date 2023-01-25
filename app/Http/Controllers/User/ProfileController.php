<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\TarifModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
  use MainInfo;

    public function index() {

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


}
