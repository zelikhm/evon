<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\HouseCharacteristicsModel;
use App\Models\Builder\HouseFilesModel;
use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseMainImageModel;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseNewsModel;
use App\Models\Builder\HouseSupportModel;
use App\Models\Builder\HouseViewsModel;
use App\Models\Builder\Info\CityModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use App\Models\User;
use App\Services\Cache\CacheService;
use App\Services\Houses\HousesService;
use App\Services\Image\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use function League\Flysystem\type;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class HouseController extends Controller
{
  use MainInfo;
  use AuthCheck;

  /**
   * edit image for house\main\flat
   * @param Request $request
   * @param ImageService $imageService
   */

  public function editImage(Request $request, ImageService $imageService) {
    $imageService->edit($request->type, $request->image, $request->id);

    return response()->json(true, 200);
  } //end

  /**
   * search object for user
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function search(Request $request)
  {

    $search = collect();

    $houses = HouseModel::where('title', 'LIKE', '%' . $request->title . '%')
      ->where('active', 2)
      ->where('visible', 1)
      ->orWhere('description', 'LIKE', $request->title . '%')
      ->orWhere('city', 'LIKE', $request->title . '%')
      ->orWhere('area', 'LIKE', $request->title . '%')
      ->orWhere('created', 'LIKE', $request->title . '%')
      ->get();

    foreach ($houses as $house) {
      $search->push($this->getHouseOnId($house->id));
    }

    return response()->json($search, 200);

  }

  /**
   * get page
   * @return \Inertia\Response
   */

  public function index(Request $request, HousesService $housesService, CacheService $cacheService)
  {
    $houses = Cache::get('houses_full');

    if(!$houses) {
      $houses = $cacheService->updateCacheHouses($housesService);
    }

    return Inertia::render('AppListImmovables', [
      'houses' => $houses,
      'dops' => TypesModel::all(),
      'infos' => StructureModel::all(),
      'city' => CityModel::with(['regions'])->get(),
      'areas' => $this->getRegions(),
      'builders' => User::where('role', 1)->get(),
//      'notification' => $this->getNotification(),
      'compilation' => $this->getCompilation(Auth::id()),
      'news' => $this->getNewsForPage(),
      'adminNews' => $this->getAdminNews(),
      'user' => $this->getUser(),
      'count_houses' => HouseModel::count(),
      'free_count' => 30,
      'type' => 0,
    ]);
  }

  /**
   * get villages
   * @return \Inertia\Response
   */

  public function villages(HousesService $housesService, CacheService $cacheService)
  {

//    $user = $this->getUser();

//    $limit = 30;
//
//    if($user->subscriptionInfo !== null && $user->subscriptionInfo->free === 1) {
//      $limit = 10;
//    }

    $houses = Cache::get('houses_villages_full');

    if(!$houses) {
      $houses = $cacheService->updateCacheVillages($housesService);
    }

    return Inertia::render('AppListImmovables', [
      'houses' => $houses,
      'dops' => TypesModel::all(),
      'infos' => StructureModel::all(),
      'city' => CityModel::with(['regions'])->get(),
      'areas' => $this->getRegions(),
      'builders' => User::where('role', 1)->get(),
//      'notification' => $this->getNotification(),
      'compilation' => $this->getCompilation(Auth::id()),
      'news' => $this->getNewsForPage(),
      'adminNews' => $this->getAdminNews(),
      'user' => $this->getUser(),
      'count_houses' => HouseModel::count(),
      'free_count' => 30,
      'type' => 1,
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
      'user' => $this->getUser(),
      'admin' => null,
      'token' => $token = Auth::user()->token,
    ]);

  }

  /**
   * get house with help token
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getHouseForUserApi(Request $request)
  {

    if ($this->checkToken($request->token)) {

      return response()->json($this->getHouseForUserPagination($request->user_id), 200);

    } else {

      return response()->json('not auth', 401);

    }

  }

  /**
   * show all house for user
   * @return \Inertia\Response
   */

  public function showHouse()
  {

    $admin = Auth::user()->role > 1 ? true : false;

    if(Auth::user()->role === 1) {
      return Inertia::render('AppPrivateOfficeDev', [
        'houses' => $this->getHouseForUserPagination(Auth::id()),
        'user' => $this->getUser(),
        'admin' => $admin
      ]);
    } else {
      return Inertia::render('AppPrivateOfficeDev', [
        'houses' => $this->getHouseForAdminPagination(30),
        'user' => $this->getUser(),
        'admin' => $admin
      ]);
    }


  }

  /**
   * get houses for admin
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getHousesForAdmin(Request $request) {

    if($this->checkToken($request->token)) {

      return response()->json($this->getHouseForAdminPagination(1000), 200);

    } else {

      return response()->json('not auth', 401);

    }

  }

  /**
   * get count houses
   * @return \Illuminate\Http\JsonResponse
   */

  public function getCountHouse() {

    return response()->json(HouseModel::count(), 200);

  }

  /**
   * get house api
   * @param Request $request
   * @return \Inertia\Response
   */

  public function getHouseApi(Request $request)
  {
    if ($this->checkToken($request->token)) {
      return $this->house($request->slug);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * get jk houses in api
   * @param Request $request
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  public function getHousesJk(Request $request, HousesService $housesService)
  {

    if ($this->checkToken($request->token)) {
      return $housesService->getHouses('Новостройка', $request->limit, $request->dop, $request->limit_count);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * get villages in api
   * @param Request $request
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  public function getHousesVillages(Request $request, HousesService $housesService)
  {
    if ($this->checkToken($request->token)) {
      return $housesService->getHouses('Вилла', $request->limit, $request->dop, $request->limit_count);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * render page for house
   * @param $slug
   * @return \Inertia\Response
   */

  public function house($slug)
  {

    $house = HouseModel::where('slug', $slug)
      ->where('user_id', Auth::id())
      ->first();

    if ($house === null) {
      $house = HouseModel::where('slug', $slug)
        ->where('active', 2)
        ->where('visible', 1)
        ->firstOrFail();
    }

    HouseViewsModel::create([
      'house_id' => $house->id,
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

    $house = $this->getHouseSlug($slug);

    if ($house->info === null) {
      return redirect(404);
    }

    return Inertia::render('AppDescriptionObject', [
      'house' => $house,
      'dops' => $this->getDop(),
      'infos' => $this->getInfo(),
      'city_array' => $this->getCity(),
      'area_array' => $this->getRegions(),
      'notification' => $this->getNotification(),
      'user' => $this->getUser(),
      'compilation' => $this->getCompilation(Auth::id()),
      'slider' => $this->getSlider($this->getHouseSlug($slug)),
    ]);

  }

  /**
   * edit house for user
   * @param $slug
   * @return \Inertia\Response
   */

  public function edit($slug)
  {
    HouseModel::where('slug', $slug)->firstOrFail();

    if(Auth::user()->role === 1) {

      $user = $this->getUser();
      $token = $user->token;

    } else if(Auth::user()->role === 2 || Auth::user()->role === 3) {

      $house = $this->getHouseSlug($slug);
      $user = User::where('id', $house->user_id)->first();
      $token = Auth::user()->token;

    }

    return Inertia::render('AppAddObject', [
      'house' => $this->getHouseSlug($slug),
      'dops' => $this->getDop(),
      'infos' => $this->getInfo(),
      'city' => $this->getCity(),
      'notification' => $this->getNotification(),
      'user' => $user,
      'token' => $token,
      'admin' => Auth::user()->role > 1 ? Auth::user() : null,
    ]);
  }

  /**
   * delete house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {
    if ($this->checkToken($request->token)) {
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

  public function create(Request $request, HousesService $housesService)
  {
    if ($this->checkToken($request->token)) {
      if ($request->floors && $request->count_flat) {
        $house = HouseModel::create([
          'user_id' => $request->user_id,
          'title' => $request->title,
          'slug' => Str::slug(mb_substr(Str::random(40), 0, 50), '-'),
          'description' => $request->description,
          'description_en' => $request->description_en,
          'description_tr' => $request->description_tr,
          'city' => $request->city,
          'area' => $request->area,
          'created' => $request->created,
          'longitude' => $request->longitude,
          'latitude' => $request->latitude,
          'percent' => $request->percent,
          'comment' => $request->comment,
          'active' => 0,
          'fool_price' => $request->fool_price,
          'created_at' => Carbon::now()->addHour(3),
          'updated_at' => Carbon::now()->addHour(3),
        ]);

        $housesService->mainImage($house->id, $request->file('mainImage'), 0);

        if ($request->info !== null) {
          $info = explode(',', $request->info);
          $str = '[';
          $i = 0;
          foreach ($info as $item) {
            if ($i !== 0) {
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

        if ($request->dop !== null) {
          $dop = explode(',', $request->dop);

          $str1 = '[';
          $i = 0;
          foreach ($dop as $item) {
            if ($i !== 0) {
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
          'exclusive' => $request->exclusive,
          'floors' => $request->floors,
          'type' => $request->type,
          'dop' => $str1,
          'info' => $str,
          'toSea' => (int)$request->toSea === 0 ? null : (int)$request->toSea,
          'toSchool' => (int)$request->toSchool === 0 ? null : (int)$request->toSchool,
          'toShop' => (int)$request->toShop === 0 ? null : (int)$request->toShop,
          'toPark' => (int)$request->toPark === 0 ? null : (int)$request->toPark,
          'toBus' => (int)$request->toBus === 0 ? null : (int)$request->toBus,
          'toChildrenSchool' => (int)$request->toChildrenSchool === 0 ? null : (int)$request->toChildrenSchool,
          'count_flat' => $request->count_flat,
          'created_at' => Carbon::now()->addHour(3),
          'updated_at' => Carbon::now()->addHour(3),
        ]);
      }

      return response()->json($house, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit house
   * @param Request $request
   * @param HousesService $housesService
   * @return \Illuminate\Http\JsonResponse
   */

  public function editHouse(Request $request, HousesService $housesService)
  {

    if ($this->checkToken($request->token)) {

      $house = HouseModel::where('id', $request->house_id)
        ->update([
          'title' => $request->title,
          'description' => $request->description,
          'description_en' => $request->description_en,
          'description_tr' => $request->description_tr,
          'city' => $request->city,
          'area' => $request->area,
          'created' => $request->created,
          'longitude' => $request->longitude,
          'latitude' => $request->latitude,
          'percent' => $request->percent === 'null' ? null : $request->percent,
          'comment' => $request->comment,
          'active' => 0,
          'fool_price' => $request->fool_price,
          'updated_at' => Carbon::now()->addHour(3),
        ]);

      $housesService->mainImage($request->house_id, $request->file('mainImage'), 1);

      if ($request->info !== null) {
        $info = explode(',', $request->info);
        $str = '[';
        $i = 0;
        foreach ($info as $item) {
          if ($i !== 0) {
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

      if ($request->dop !== null) {
        $dop = explode(',', $request->dop);

        $str1 = '[';
        $i = 0;
        foreach ($dop as $item) {
          if ($i !== 0) {
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

      HouseCharacteristicsModel::where('house_id', $request->house_id)
        ->update([
          'exclusive' => $request->exclusive,
          'floors' => $request->floors,
          'type' => $request->type,
          'dop' => $str1,
          'info' => $str,
          'toSea' => (int)$request->toSea === 0 ? null : (int)$request->toSea,
          'toSchool' => (int)$request->toSchool === 0 ? null : (int)$request->toSchool,
          'toShop' => (int)$request->toShop === 0 ? null : (int)$request->toShop,
          'toPark' => (int)$request->toPark === 0 ? null : (int)$request->toPark,
          'toBus' => (int)$request->toBus === 0 ? null : (int)$request->toBus,
          'toChildrenSchool' => (int)$request->toChildrenSchool === 0 ? null : (int)$request->toChildrenSchool,
          'count_flat' => $request->count_flat,
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
    if ($this->checkToken($request->token)) {

      if ($request->image_up) {
        $imageUp = time() . '.flat.'. $request->file('image_up')->getClientOriginalExtension();
        $request->image_up->move(public_path('/storage/buffer'), $imageUp);
        $this->waterMark($imageUp, 'storage/flat/', false);
        $imageUp = '/storage/flat/' . $imageUp;
      } else {
        $flat = FlatModel::where('id', $request->flat_id)->first();
        $imageUp = $flat !== null ? $flat->imageUp : null;
      }

      if ($request->image_down) {
        $imageDown = time() . '.flat.'. $request->file('image_down')->getClientOriginalExtension();
        $request->image_down->move(public_path('/storage/buffer'), $imageDown);
        $this->waterMark($imageDown, 'storage/flat/', false);
        $imageDown = '/storage/flat/' . $imageDown;
      } else {
        $flat = FlatModel::where('id', $request->flat_id)->first();
        $imageDown = $flat !== null ? $flat->imageDown : null;
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
        'imageUp' => $imageUp,
        'imageDown' => $imageDown,
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

  public function deletedFlat(Request $request)
  {
    if ($this->checkToken($request->token)) {

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

  public function editFlat(Request $request)
  {
    if ($this->checkToken($request->token)) {
      if ($request->image_up === 'null' ) {
        $imageUp = null;
      } else if ($request->image_up) {
        $imageUp = time() . '.flat.'. $request->file('image_up')->getClientOriginalExtension();
        $request->image_up->move(public_path('/storage/buffer'), $imageUp);
        $this->waterMark($imageUp, 'storage/flat/', false);
        $imageUp = '/storage/flat/' . $imageUp;
      } else {
        $flat = FlatModel::where('id', $request->flat_id)->first();
        if ($flat->imageUp !== null) {
          $imageUp = $flat->imageUp;
        }
      }

      if ($request->image_down === 'null') {
        $imageDown = null;
      } else if ($request->image_down) {
        $imageDown = (time() + 100) . '.flat.'. $request->file('image_down')->getClientOriginalExtension();
        $request->image_down->move(public_path('/storage/buffer'), $imageDown);
        $this->waterMark($imageDown, 'storage/flat/', false);
        $imageDown = '/storage/flat/' . $imageDown;
      } else {
        $flat = FlatModel::where('id', $request->flat_id)->first();
        if ($flat->imageDown !== null) {
          $imageDown = $flat->imageDown;
        }
      }

      FlatModel::where('id', $request->flat_id)
        ->update([
          'number' => $request->number,
          'square' => $request->square,
          'count' => $request->count,
          'floor' => $request->floor,
          'status' => $request->status,
          'number_from_stairs' => $request->stairs,
          'price' => $request->price,
          'imageUp' => $imageUp,
          'imageDown' => $imageDown,
        ]);

      HouseModel::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json($this->getHouse($request->house_id), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit status for flat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editStatusFlat(Request $request)
  {

    if ($this->checkToken($request->token)) {

      FlatModel::where('id', $request->flat_id)->update([
        'status' => $request->status,
      ]);

      HouseModel::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json($this->getHouse($request->house_id), 200);
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
    if ($this->checkToken($request->token)) {
      FrameModel::create([
        'house_id' => $request->house_id,
        'name' => $request->name,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json(FrameModel::where('house_id', $request->house_id)->with(['flats'])->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editFrame(Request $request)
  {
    if ($this->checkToken($request->token)) {

      FrameModel::where('id', $request->frame_id)
        ->update([
          'name' => $request->name,
          'updated_at' => Carbon::now()->addHour(3),
        ]);

      HouseModel::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json(FrameModel::where('house_id', $request->house_id)->with(['flats'])->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * deleted frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deleteFrame(Request $request)
  {
    if ($this->checkToken($request->token)) {

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
    if ($this->checkToken($request->token)) {

      if ($request->avatar) {
        $imageName = time() . '.support.' . $request->file('image')->getClientOriginalExtension();
        $request->avatar->move(public_path('/storage/support'), $imageName);
      } else {
        $imageName = null;
      }

      HouseSupportModel::create([
        'house_id' => $request->house_id,
        'avatar' => '/storage/support/' . $imageName,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'status' => $request->status,
        'link' => $request->link,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json(HouseSupportModel::where('house_id', $request->house_id)->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit support
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editSupport(Request $request)
  {

    if ($this->checkToken($request->token)) {
      if ($request->avatar !== 'not') {
        $imageName = time() . '.support.' . $request->file('image')->getClientOriginalExtension();
        $request->avatar->move(public_path('/storage/support'), $imageName);
        $imageName = '/storage/support/' . $imageName;
      } else {
        $sup = HouseSupportModel::where('id', $request->id)->first();
        $imageName = $sup->avatar;
      }

      HouseSupportModel::where('id', $request->id)
        ->update([
          'avatar' => $imageName,
          'name' => $request->name,
          'phone' => $request->phone,
          'email' => $request->email,
          'status' => $request->status,
          'link' => $request->link,
          'created_at' => Carbon::now()->addHour(3),
          'updated_at' => Carbon::now()->addHour(3),
        ]);

      return response()->json(HouseSupportModel::where('house_id', $request->house_id)->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * delete supports with help id
   * @param Request $request
   */

  public function deleteSupport(Request $request)
  {
    if ($this->checkToken($request->token)) {

      HouseSupportModel::where('id', $request->id)->delete();
      return response()->json(true, 205);

    } else {

      return response()->json('not auth', 401);

    }

  }

  /**
   * all delete supports
   * @param Request $request
   */

  public function clearSupport(Request $request)
  {
    if ($this->checkToken($request->token)) {

      HouseSupportModel::where('house_id', $request->house_id)->delete();
      return response()->json(true, 205);

    } else {

      return response()->json('not auth', 401);

    }

  }

  /**
   * get house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function get(Request $request)
  {
    if ($this->checkToken($request->token)) {
      $house = $this->getHouseSlug($this->getHouse($request->id)->slug);

      return response()->json($house, 200);
    } else {
      return response()->json('not auth', 401);
    }
  } //end

  /**
   * edit visible for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function setVisible(Request $request)
  {
    if ($this->checkToken($request->token)) {

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
   * added files for houses
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedFiles(Request $request)
  {
    if ($this->checkToken($request->token)) {

      $fileName = time() . '.files.' . $request->file('file')->getClientOriginalExtension();
      $request->file('file')->move(public_path('/storage/files'), $fileName);

      $file = HouseFilesModel::create([
        'house_id' => $request->house_id,
        'name' => '/storage/files/' . $fileName,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json($file, 200);

    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * deleted file
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deletedFile(Request $request)
  {
    if ($this->checkToken($request->token)) {
      HouseFilesModel::where('name', $request->fileName)->delete();

      return response()->json(HouseFilesModel::where('house_id', $request->house_id)->get(), 200);

    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * added images for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedImages(Request $request, ImageService $imageService)
  {

    if ($this->checkToken($request->token)) {

      $imageName = time() . '.house.' . $request->file('image')->getClientOriginalExtension();
      $request->file('image')->move(public_path('/storage/buffer'), $imageName);

      $image = HouseImagesModel::create([
        'house_id' => $request->house_id,
        'name' => "/storage/buffer/" . $imageName,
        'category' => $request->category_id,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      $imageService->add($image->id, 0, $request->file('image'), $imageName);

      HouseModel::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json("/storage/buffer/".$imageName, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * added watermark on the photo
   * @param $image_buffer
   * @param $path
   */

  public function waterMark($image_buffer, $path, $blur)
  {
    $image = Image::make('storage/buffer/' . $image_buffer);
    $image->insert('images/watermark.png');
//    $image->resize(600, 420);
    $image->heighten(420);

    if($blur) {
      $image1 = Image::make('storage/' . $image_buffer);
      $image1->resize(800, 420);
      $image1->blur(50);
      $image1->insert($image, 'center');

      $image1->save($path . $image_buffer, 100);
    } else {

      $image->save($path . $image_buffer, 100);
    }

    unlink('storage/buffer/'. $image_buffer);
  }

  /**
   * deleted image
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deletedImage(Request $request)
  {

    if ($this->checkToken($request->token)) {

      HouseImagesModel::where('name', $request->image_name)
        ->where('house_id', $request->house_id)
        ->delete();

      HouseModel::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json(HouseImagesModel::where('house_id', $request->house_id)->get(), 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

  public function getInfos()
  {

    return TypesModel::all();

  }

  public function getDops()
  {

    return StructureModel::all();

  }

  public function getCityes()
  {

    return $this->getCity();

  }

}
