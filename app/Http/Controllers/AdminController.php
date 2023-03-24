<?php

namespace App\Http\Controllers;

use App\Models\Builder\HouseModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function success(Request $request) {

      HouseModel::where('id', $request->house_id)->update([
        'active' => 2
      ]);

      return redirect()->to(redirect()->getUrlGenerator()->previous());
    }

    function failed(Request $request) {
      HouseModel::where('id', $request->house_id)->update([
        'active' => 0
      ]);

      return redirect()->to(redirect()->getUrlGenerator()->previous());
    }
}
