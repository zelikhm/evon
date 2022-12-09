<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseNewsModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{

  /**
   * render page
   * @param $slug
   * @return \Inertia\Response
   */

  public function index($slug) {

    $house = HouseModel::where('slug', $slug)->with(['news'])->first();

    return Inertia::render('', [
      'house' => $house
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
