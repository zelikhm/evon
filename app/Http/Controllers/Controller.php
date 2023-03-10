<?php

namespace App\Http\Controllers;

use App\Http\Traits\MainInfo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MainInfo;

    public function main() {

      return Inertia::render('AppMain', [
        'userInfo' => $this->getUser()
      ]);
    }
}
