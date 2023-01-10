<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\FavoritesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function add(Request $request) {
      if($request->token === env('TOKEN')) {

        FavoritesModel::create([
          'user_id' => $request->user_id,
          'house_id' => $request->house_id,
          'created_at' => Carbon::now()->addHour(3),
          'updated_at' => Carbon::now()->addHour(3),
        ]);

        return response()->json($request->user_id, 200);
      } else {
        return response()->json('not auth', 401);
      }

    }

  /**
   * get all favorites
   * @return mixed
   */

    public function getAll() {
      return FavoritesModel::where('user_id')->get();
    }
}
