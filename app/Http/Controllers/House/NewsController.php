<?php

namespace App\Http\Controllers\House;

use App\Http\Admin\House\HouseNews;
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\House;
use App\Models\Builder\HouseNew;
use App\Models\News\AdminNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NewsController extends Controller
{
  use MainInfo;
  use AuthCheck;

  /**
   * render page
   * @return \Inertia\Response
   */

  public function index() {

    return Inertia::render('AppNews', [
      'houses' => $this->getHouseForUser(Auth::id()),
      'news' => $this->getNews(Auth::id()),
      'user' => $this->getUser(),
      'notification' => $this->getNotification(),
    ]);

  }

  /**
   * get all news
   * @return mixed
   */

  public function getAllNews() {

    $news = HouseNews::where('visible', 1)
      ->with(['house'])
      ->orderBy('created_at', 'ASC')
      ->get();

    $collections = collect();

    foreach ($news as $item) {

      if($item->house !== []) {
        if($item->house->active === 2 && $item->house->visible === 1) {
          $item->house->image = $this->getPhoto($item->house);
          $collections->push($item);
        }
      }

    }

    return $collections;
  }

  /**
   * get all news for admin
   * @return \Illuminate\Database\Eloquent\Collection
   */

  public function getAllNewsAdmin() {

    return AdminNew::all();

  }

  /**
   * get all news for user
   * @param Request $request
   * @return \Illuminate\Support\Collection
   */

  public function getAllNewsForUser(Request $request) {
    $collections = collect();

    $houses = $this->getHouseForUser($request->user_id);

    foreach ($houses as $house) {
      $news = HouseNews::where('house_id', $house->id)->get();
      if(count($news) > 0) {
        $collections->push($news);
      }
    }

    return $collections;
  }

  /**
   * get new
   * @param Request $request
   * @return mixed
   */

  public function getNew(Request $request) {

    return HouseNews::where('id', $request->new_id)->first();

  }

  /**
   * edit news
   * @param $id
   * @return \Inertia\Response
   */

  public function editNews($id) {

    $new = HouseNews::where('id', $id)->with(['house'])->first();

    if($new === null) {
      redirect('/news');
    }

    if(Auth::user()->role === 1) {
      $houses = $this->getHouseForUser(Auth::id());
    } else {
      $houses = $this->getHouseForUser($new->house->user_id);
    }

    return Inertia::render('AppAddNews', [
      'houses' => $houses,
      'new' => $new,
      'user' => $this->getUser(),
      'notification' => $this->getNotification(),
    ]);

  }

  /**
   * render page for create new
   * @return \Inertia\Response
   */

  public function createNews() {

    return Inertia::render('AppAddNews', [
      'houses' => $this->getHouseForUser(Auth::id()),
      'user' => $this->getUser(),
      'notification' => $this->getNotification(),
    ]);

  }

  /**
   * added news for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function add(Request $request) {
    if($this->checkToken($request->token)) {
      $news = HouseNews::create([
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
    if($this->checkToken($request->token)) {
      $new = HouseNews::where('id', $request->new_id)
        ->update([
          'house_id' => $request->house_id,
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
    if($this->checkToken($request->token)) {
      HouseNews::where('id', $request->new_id)
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
    if($this->checkToken($request->token)) {
      $new = HouseNews::where('id', $request->new_id)
        ->update([
          'visible' => $request->visible
        ]);

      return response()->json($new, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

}
