<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\User\Favorite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoriteController extends Controller
{

  use MainInfo;
  use AuthCheck;

  /**
   * get favorites
   * @return \Inertia\Response
   */

  public function index() {

    $favorite = Favorite::where('user_id', Auth::id())->get();

    foreach ($favorite as $item) {
      $house = $this->getHouseOnId($item->house_id);
      $item->house = $this->getHouseSlug($house->slug);
    }

    return Inertia::render('AppFavorites', [
      'favorites' => $favorite,
      'user' => $this->getUser()
    ]);
  }

  /**
   * added favorites
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

    public function add(Request $request) {
      if($this->checkToken($request->token)) {

        $favorites = Favorite::create([
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
      if($this->checkToken($request->token)) {

        Favorite::where('user_id', $request->user_id)
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

      $favorites = Favorite::where('user_id', $request->user_id)->get();

      foreach ($favorites as $item) {
        $house = $this->getHouseOnId($item->house_id);
        $item->house = $this->getHouseSlug($house->slug);
      }

      return $favorites;
    }
}
