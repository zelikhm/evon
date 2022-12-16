<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseNewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NewsController extends Controller
{
  use MainInfo;

  /**
   * render page
   * @return \Inertia\Response
   */

  public function index() {

    return Inertia::render('AppNews', [
      'houses' => $this->getHouseForUser(Auth::id()),
      'news' => $this->getNews(Auth::id()),
      'user' => Auth::user(),
      'notification' => $this->getNotification(),
    ]);

  }

  /**
   * added news for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function add(Request $request) {
    if($request->token === env('TOKEN')) {
      $news = HouseNewsModel::create([
        'house_id' => $request->house_id,
        'title' => $request->title,
        'description' => $request->description,
        'visible' => true,
      ]);

      return response()->json($news, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit new
   * @param Request $request
   */

  public function edit(Request $request) {
    if($request->token === env('TOKEN')) {
      $new = HouseNewsModel::where('id', $request->new_id)
        ->update([
          'title' => $request->title,
          'description' => $request->description,
        ]);

      return response()->json($new, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * delete new
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request) {
    if($request->token === env('TOKEN')) {
      HouseNewsModel::where('id', $request->new_id)
        ->delete();

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit visible
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function visible(Request $request) {
    if($request->token === env('TOKEN')) {
      $new = HouseNewsModel::where('id', $request->new_id)
        ->update([
          'visible' => $request->visible
        ]);

      return response()->json($new, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

}
