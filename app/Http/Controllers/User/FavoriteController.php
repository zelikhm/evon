<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\FavoritesModel;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function add(Request $request) {
      if($request->token === env('TOKEN')) {
        FavoritesModel::create([
          'user_id', $request->user_id,
          'house_id', $request->house_id,
        ]);

        return response()->json(true, 200);
      } else {
        return response()->json('not auth', 401);
      }

    }
}
