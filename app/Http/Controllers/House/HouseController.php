<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\HouseCharacteristicsModel;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseSupportModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HouseController extends Controller
{
  use MainInfo;

  /**
   * get page
   * @return \Inertia\Response
   */

  public function index()
  {

    $houses = $this->getAllHouse();

    dd($houses);

    foreach ($houses as $house) {
      $house->dop_array = TypesModel::where('id', $house->dop)->get();
      $house->info_array = StructureModel::where('id', $house->info)->get();
    }

    return Inertia::render('AppListImmovables', [
      'houses' => $houses,
    ]);
  }

  /**
   * create house
   * @return \Inertia\Response
   */

  public function createHouse() {

    return Inertia::render('AppAddObject', [
      'dops' => $this->dops(),
      'infos' => $this->infos(),
    ]);

  }

  /**
   * render page for house
   * @param $slug
   * @return \Inertia\Response
   */

  public function house($slug) {

    return Inertia::render('', [
      'house' => $this->getHouseSlug($slug),
      'dops' => $this->dops(),
      'infos' => $this->infos(),
    ]);

  }

  /**
   * create house and characteristics
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      $house = HouseModel::create([
        'user_id' => $request->user_id,
        'title' => $request->title,
        'slug' => Str::slug(mb_substr($request->title, 0, 50), '-'),
        'description' => $request->description,
        'city' => $request->city,
        'area' => $request->area,
        'longitude' => $request->longitude,
        'latitude' => $request->latitude,
        'percent' => $request->percent,
        'comment' => $request->comment,
        'active' => 0,
        'status' => 'нету',
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      HouseCharacteristicsModel::create([
        'house_id' => $house->id,
        'status' => $request->statusHouse,
        'floors' => $request->floors,
        'type' => $request->type,
        'dop' => $request->dop,
        'info' => $request->info,
        'toSea' => $request->toSea,
        'toSchool' => $request->toSchool,
        'toShop' => $request->toShop,
        'toPark' => $request->toPark,
        'toChildrenSchool' => $request->toChildrenSchool,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json($house, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * create flat for frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function createFlat(Request $request) {
    if($request->token === env('TOKEN')) {
      $flat = FlatModel::create([
        'frame_id' => $request->frame_id,
        'number' => $request->number,
        'square' => $request->square,
        'count' => $request->count,
        'floor' => $request->floor,
        'status' => $request->status,
        'number_from_stairs' => $request->stairs,
        'price' => $request->price,
      ]);

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * create frame for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function createFrame(Request $request) {
    if($request->token === env('TOKEN')) {
      FrameModel::create([
        'house_id' => $request->house_id,
        'name' => $request->name,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json(FrameModel::where('house_id', $request->house_id)->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * added support for house
   * @param Request $request
   */

  public function supports(Request $request) {
    if ($request->token === env('TOKEN')) {
      $support = HouseSupportModel::create([
        'house_id' => $request->house_id,
        'avatar' => $request->avatar,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'status' => $request->status,
        'link' => $request->link,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json($support, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * get house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function get(Request $request) {
    if($request->token === env('TOKEN')) {
      $house = $this->getHouse($request->id);

      return response()->json($house, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * added images for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedImages(Request $request) {
    if ($request->token === env('TOKEN')) {


      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }
}
