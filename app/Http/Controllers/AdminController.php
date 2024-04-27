<?php

namespace App\Http\Controllers;

use App\Models\Builder\House;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function success(Request $request) {

      House::where('id', $request->house_id)->update([
        'active' => 2
      ]);

      return redirect()->to(redirect()->getUrlGenerator()->previous());
    }

    function failed(Request $request) {
      House::where('id', $request->house_id)->update([
        'active' => 0
      ]);

      return redirect()->to(redirect()->getUrlGenerator()->previous());
    }
}
