<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HelpController extends Controller
{
    public function getHelp() {

      return Inertia::render('', [

      ]);

    }
}
