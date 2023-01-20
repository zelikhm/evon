<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\User\FavoritesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoriteController extends Controller
{

  use MainInfo;

  /**
   * get favorites
   * @return \Inertia\Response
   */

  public function index() {

    $favorite = FavoritesModel::where('user_id', Auth::id())->get();

    foreach ($favorite as $item) {

      $item->house = $this->getHouseOnId($item->house_id);

    }

    return Inertia::render('AppFavorites', [
      'favorites' => $favorite,
    ]);
  }

  /**
   * added favorites
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

    public function add(Request $request) {
      if($request->token === env('TOKEN')) {

        $favorites = FavoritesModel::create([
          'user_id' => $request->user_id,
          'house_id' => $request->house_id,
          'created_at' => Carbon::now()->addHour(3),
          'updated_at' => Carbon::now()->addHour(3),
        ]);

        return response()->json($favorites, 200);
      } else {
        return response()->json('not auth', 401);
      }

    }

  /**
   * deleetd
   * @param Request $request
   * @return \Illuminate\Http\JsonResponsed
   */

    public function deleted(Request $request) {
      if($request->token === env('TOKEN')) {

        FavoritesModel::where('user_id', $request->user_id)
          ->where('house_id', $request->house_id)
          ->delete();

        return response()->json('true', 205);
      } else {
        return response()->json('not auth', 401);
      }
    }

  /**
   * get all favorites
   * @return mixed
   */

    public function getAll(Request $request) {
      return FavoritesModel::where('user_id', $request->user_id)->get();
    }
}
