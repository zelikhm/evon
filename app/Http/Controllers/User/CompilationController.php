<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseModel;
use App\Models\Builder\Info\CityModel;
use App\Models\User;
use App\Models\User\CompilationInfoModel;
use App\Models\User\CompilationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class CompilationController extends Controller
{

  use MainInfo;

  public function index()
  {

    $compilations = $this->getCompilations(Auth::id());

    if(count($compilations) > 0) {

      foreach ($compilations as $compilation) {
        if(count($compilation->values) > 0) {
            $house = $this->getHouseOnId($compilation->values[0]->house_id);
            $compilation->image = $this->getPhoto($house);
        } else {
          $compilation->image = null;
        }

      }
    }

    return Inertia::render('AppSelections', [

      'compilation' => $compilations,
      'user' => Auth::user(),
      'notification' => $this->getNotification(),

    ]);

  }

  /**
   * get compilation
   * @param Request $request
   * @return mixed
   */

  public function getAll(Request $request) {

    return $this->getCompilations($request->user_id);

  }

  public function get(Request $request) {
    return $this->getCompilation($request->id);
  }

  /**
   * show houses in the compilation
   * @param $id
   * @return \Inertia\Response
   */

  public function show($id)
  {
    $compilation = CompilationModel::where('id', $id - 10000)->with(['values', 'user', 'company'])->firstOrFail();

    $houses = collect();

    foreach ($compilation->values as $value) {
      $houses->push($this->getHouseOnId($value->house_id));
    }

    $cities = CityModel::all();

    $houses_cities = array();

    foreach ($houses as $house) {
      foreach ($cities as $city) {
        if($city->title === $house->city) {
          if(array_key_exists($city->title, $houses_cities)) {
            array_push($houses_cities[$city->title], $house);
          } else {
            $houses_cities[$city->title] = [$house];
          }
        }
      }
    }

    if(Auth::check()) {
      $user = User::where('id', Auth::id())->with(['company'])->first();
    } else {
      $user = [];
    }

    return Inertia::render('AppLinkSelection', [
      'houses' => $houses_cities,
      'compilation' => $compilation,
      'user' => $user,
    ]);

  }

  /**
   * show house in the compilation
   * @param $id
   * @param $house
   * @return \Inertia\Response
   */

  public function house($id, $house) {

    HouseModel::where('slug', $house)->firstOrFail();

    $house = $this->getHouseSlug($house);

    $compilation = CompilationInfoModel::where('compilation_id', $id - 10000)
      ->where('house_id', $house->id)
      ->firstOrFail();

    if(Auth::check()) {
      $user = User::where('id', Auth::id())->with(['company'])->first();
    } else {
      $user = [];
    }

    $compilation = CompilationModel::where('id', $id - 10000)->with(['values', 'user', 'company'])->firstOrFail();

    return Inertia::render('AppLinkDescriptionObject', [
      'house' => $house,
      'compilation' => $compilation,
      'user' => $user,
      'dops' => $this->getDop(),
      'infos' => $this->getInfo(),
    ]);

  }

  /**
   * edit compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function edit(Request $request)
  {

    if ($request->token === env('TOKEN')) {

       CompilationModel::where('id', $request->id)->update([
        'title' => $request->title,
        'description' => $request->description,
        'isVisible' => $request->isVisible,
      ]);

      $compilations = $this->getCompilations($request->user_id);

      if(count($compilations) > 0) {

        foreach ($compilations as $compilation) {
          if(count($compilation->values) > 0) {
            $house = $this->getHouseOnId($compilation->values[0]->house_id);
            $compilation->image = $this->getPhoto($house);
          } else {
            $compilation->image = null;
          }

        }
      }

      return response()->json($compilations, 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * create compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      $compl = CompilationModel::create([
        'user_id' => $request->user_id,
        'title' => $request->title,
        'description' => $request->description,
        'isVisible' => $request->isVisible,
        'comment' => $request->comment,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json($compl->id, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * add house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addHouse(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      CompilationInfoModel::create([
        'compilation_id' => $request->compilation_id,
        'house_id' => $request->house_id,
        'description' => $request->description,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      $compilation = CompilationModel::where('id', $request->compilation_id)->with(['values', 'user', 'company'])->first();

      $houses = collect();

      foreach ($compilation->values as $value) {
        $houses->push($this->getHouseOnId($value->house_id));
      }

      $compilation->houses = $houses;

      return response()->json($compilation, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * delete house in the compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deleteHouse(Request $request) {

    if ($request->token === env('TOKEN')) {

      CompilationInfoModel::where('compilation_id', $request->compilation_id)
        ->where('house_id', $request->house_id)
        ->delete();

      $compilation = CompilationModel::where('id', $request->compilation_id)->with(['values', 'user', 'company'])->firstOrFail();

      return response()->json($compilation, 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * delete compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      CompilationInfoModel::where('compilation_id', $request->id)
        ->delete();
      CompilationModel::where('id', $request->id)
        ->delete();

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }
}
