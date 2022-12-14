<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\HouseCharacteristicsModel;
use App\Models\Builder\HouseFilesModel;
use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseNewsModel;
use App\Models\Builder\HouseSupportModel;
use App\Models\Builder\HouseViewsModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use function League\Flysystem\type;
use function Symfony\Component\Routing\Loader\Configurator\collection;

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

    foreach ($houses as $house) {
      $house->dop_array = TypesModel::where('id', $house->dop)->get();
      $house->info_array = StructureModel::where('id', $house->info)->get();
    }

    return Inertia::render('AppListImmovables', [
      'houses' => $houses,
      'notification' => $this->getNotification(),
      'user' => Auth::user(),
    ]);
  }

  /**
   * create house
   * @return \Inertia\Response
   */

  public function createHouse()
  {
    return Inertia::render('AppAddObject', [
      'dops' => $this->getDop(),
      'infos' => $this->getInfo(),
      'city' => $this->getCity(),
      'notification' => $this->getNotification(),
      'count' => HouseModel::count(),
      'user' => Auth::user(),
    ]);

  }

  /**
   * show all house for user
   * @return \Inertia\Response
   */

  public function showHouse()
  {
    return Inertia::render('AppPrivateOfficeDev', [
      'houses' => $this->getHouseForUserPagination(Auth::id()),
      'user' => Auth::user(),
    ]);
  }

  public function getHouseApi(Request $request) {
    return $this->house($request->slug);
  }

  public function getHousesApi(Request $request) {
    return $this->getAllHouse();
  }

  /**
   * render page for house
   * @param $slug
   * @return \Inertia\Response
   */

  public function house($slug)
  {

    $house = HouseModel::where('slug', $slug)->firstOrFail();

    HouseViewsModel::create([
      'house_id' => $house->id,
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

    return Inertia::render('AppDescriptionObject', [
      'house' => $this->getHouseSlug($slug),
      'dops' => $this->getDop(),
      'infos' => $this->getInfo(),
      'city' => $this->getCity(),
      'notification' => $this->getNotification(),
      'user' => Auth::user(),
      'slider' => $this->getSlider($this->getHouseSlug($slug)),
    ]);

  }

  /**
   * edit house for user
   * @param $slug
   * @return \Inertia\Response
   */

  public function edit($slug) {
    HouseModel::where('slug', $slug)->firstOrFail();

    return Inertia::render('AppAddObject', [
      'house' => $this->getHouseSlug($slug),
      'dops' => $this->getDop(),
      'infos' => $this->getInfo(),
      'city' => $this->getCity(),
      'notification' => $this->getNotification(),
      'user' => Auth::user(),
    ]);
  }

  /**
   * delete house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      HouseModel::where('id', $request->house_id)->delete();
      HouseViewsModel::where('house_id', $request->house_id)->delete();
      HouseImagesModel::where('house_id', $request->house_id)->delete();
      HouseNewsModel::where('house_id', $request->house_id)->delete();
      HouseCharacteristicsModel::where('house_id', $request->house_id)->delete();
      HouseSupportModel::where('house_id', $request->house_id)->delete();
      HouseFilesModel::where('house_id', $request->house_id)->delete();
      FrameModel::where('house_id', $request->house_id)->delete();

      return response()->json(true, 205);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * create house and characteristics
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request)
  {
    if ($request->image) {
      $imageName = time() . '.' . $request->image->getClientOriginalName();
      $request->image->move(public_path('storage'), $imageName);
    } else {
      $imageName = null;
    }

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
        'status' => '????????',
        'image' => $imageName,
        'fool_price' => $request->fool_price,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      if($request->info !== null) {
        $info = explode(',', $request->info);
        $str = '[';
        $i = 0;
        foreach ($info as $item) {
          if($i !== 0) {
            $str .= ',"' . $item . '"';
          } else {
            $str .= '"' . $item . '"';
          }

          $i++;
        }
        $str .= ']';
      } else {
        $str = null;
      }

      if($request->dop !== null) {
        $dop = explode(',', $request->dop);

        $str1 = '[';
        $i = 0;
        foreach ($dop as $item) {
          if($i !== 0) {
            $str1 .= ',"' . $item . '"';
          } else {
            $str1 .= '"' . $item . '"';
          }

          $i++;
        }
        $str1 .= ']';
      } else {
        $str1 = null;
      }

      HouseCharacteristicsModel::create([
        'house_id' => $house->id,
        'status' => $request->statusHouse,
        'floors' => $request->floors,
        'type' => $request->type,
        'dop' => $str1,
        'info' => $str,
        'toSea' => $request->toSea,
        'toSchool' => $request->toSchool,
        'toShop' => $request->toShop,
        'toPark' => $request->toPark,
        'toBus' => $request->toBus,
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

  public function createFlat(Request $request)
  {
    if ($request->token === env('TOKEN')) {

      if ($request->image_up) {
        $imageUp = time() . '.' . $request->image_up->getClientOriginalName();
        $request->image_up->move(public_path('/storage/'), $imageUp);
      } else {
        $imageUp = null;
      }

      if ($request->image_down) {
        $imageDown = time() . '.' . $request->image_down->getClientOriginalName();
        $request->image_down->move(public_path('/storage/'), $imageDown);
      } else {
        $imageDown = null;
      }

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

      FlatImagesModel::create([
        'flat_id' => $flat->id,
        'name' => $imageUp,
        'category' => 0,
      ]);

      FlatImagesModel::create([
        'flat_id' => $flat->id,
        'name' => $imageDown,
        'category' => 1,
      ]);

      $frame = FrameModel::where('id', $request->frame_id)->first();

      return response()->json($this->getHouse($frame->house_id), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * deleted flat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deletedFlat(Request $request) {
    if ($request->token === env('TOKEN')) {

      FlatModel::where('id', $request->flat_id)->delete();

      return response()->json('deleted', 205);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit flat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editFlat(Request $request) {
    if ($request->token === env('TOKEN')) {

      if ($request->image_up) {
        $imageUp = time() . '.' . $request->image_up->getClientOriginalName();
        $request->image_up->move(public_path('/storage/'), $imageUp);
      } else {
        $imageUp = null;
      }

      if ($request->image_down) {
        $imageDown = time() . '.' . $request->image_down->getClientOriginalName();
        $request->image_down->move(public_path('/storage/'), $imageDown);
      } else {
        $imageDown = null;
      }

      $flat = FlatModel::where('id', $request->flat_id)
        ->create([
        'number' => $request->number,
        'square' => $request->square,
        'count' => $request->count,
        'floor' => $request->floor,
        'status' => $request->status,
        'number_from_stairs' => $request->stairs,
        'price' => $request->price,
      ]);

      FlatImagesModel::create([
        'flat_id' => $flat->id,
        'name' => $imageUp,
        'category' => 0,
      ]);

      FlatImagesModel::create([
        'flat_id' => $flat->id,
        'name' => $imageDown,
        'category' => 1,
      ]);

      $frame = FrameModel::where('id', $request->frame_id)->first();

      return response()->json($this->getHouse($frame->house_id), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * create frame for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function createFrame(Request $request)
  {
    if ($request->token === env('TOKEN')) {
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
   * edit frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editFrame(Request $request) {
    if ($request->token === env('TOKEN')) {

      FrameModel::where('id', $request->frame_id)
        ->update([
        'name' => $request->name,
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json(FrameModel::where('house_id', $request->house_id)->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * deleted frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deleteFrame(Request $request) {
    if ($request->token === env('TOKEN')) {

      FrameModel::where('id', $request->frame_id)->delete();

      return response()->json('deleted', 205);
    } else {
      return response()->json('not auth', 401);
    }
  }


  /**
   * added support for house
   * @param Request $request
   */

  public function supports(Request $request)
  {
//    if ($request->token === env('TOKEN')) {

      if ($request->avatar) {
        $imageName = time() . '.' . $request->avatar->getClientOriginalName();
        $request->avatar->move(public_path('/storage/'), $imageName);
      } else {
        $imageName = null;
      }

      $support = HouseSupportModel::create([
        'house_id' => $request->house_id,
        'avatar' => $imageName,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'status' => $request->status,
        'link' => $request->link,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json($support, 200);
//      }
//    } else {
//      return response()->json('not auth', 401);
//    }
  }

  /**
   * delete supports with help id
   * @param Request $request
   */

  public function deleteSupport(Request $request) {
    HouseSupportModel::where('id', $request->id)->delete();
  }

  /**
   * all delete supports
   * @param Request $request
   */

  public function clearSupport(Request $request) {
    HouseSupportModel::where('house_id', $request->house_id)->delete();
  }

  /**
   * get house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function get(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      $house = $this->getHouse($request->id);

      return response()->json($house, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit visible for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function setVisible(Request $request)
  {
    if ($request->token === env('TOKEN')) {

      HouseModel::where('id', $request->house_id)
        ->update([
          'visible' => $request->visible,
        ]);

      return response()->json(true, 200);
    } else {
      return response()->json(false, 401);
    }

  }

  /**
   * added images for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedImages(Request $request)
  {
    if ($request->token === env('TOKEN')) {

      $imageName = time() . '.' . $request->image->getClientOriginalName();
      $request->image->move(public_path('/storage/'), $imageName);

      HouseImagesModel::create([
        'house_id' => $request->house_id,
        'name' => $imageName,
        'category' => $request->category_id,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }
}
