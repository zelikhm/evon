<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Jobs\FlatImage;
use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\HouseCharacteristic;
use App\Models\Builder\HouseFile;
use App\Models\Builder\HouseImage;
use App\Models\Builder\HouseMainImage;
use App\Models\Builder\House;
use App\Models\Builder\HouseNew;
use App\Models\Builder\HouseSupport;
use App\Models\Builder\HouseView;
use App\Models\Builder\Info\City;
use App\Models\Builder\Info\Structure;
use App\Models\Builder\Info\Type;
use App\Models\User;
use App\Services\Cache\CacheService;
use App\Services\Houses\HousesService;
use App\Services\Image\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use function League\Flysystem\type;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class HouseController extends Controller
{
  use MainInfo;
  use AuthCheck;

  private $houseService;

  public function __construct(HousesService $housesService)
  {
    $this->houseService = $housesService;
  }

  /**
   * edit image for house\main\flat
   * @param Request $request
   * @param ImageService $imageService
   */

  public function editImage(Request $request, ImageService $imageService)
  {
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

    $houses = House::where('title', 'LIKE', '%' . $request->title . '%')
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
    return Inertia::render('AppListImmovables', [
      'houses' => [],
      'dops' => Type::all(),
      'infos' => Structure::all(),
      'city' => City::with(['regions'])->get(),
      'areas' => $this->getRegions(),
      'builders' => User::where('role', 1)->get(),
//      'notification' => $this->getNotification(),
      'compilation' => $this->getCompilation(Auth::id()),
      'news' => $this->getNewsForPage(),
      'adminNews' => $this->getAdminNews(),
      'user' => $this->getUser(),
      'count_houses' => $this->houseService->getCountHouses('Новостройка'),
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
    return Inertia::render('AppListImmovables', [
      'houses' => [],
      'dops' => Type::all(),
      'infos' => Structure::all(),
      'city' => City::with(['regions'])->get(),
      'areas' => $this->getRegions(),
      'builders' => User::where('role', 1)->get(),
//      'notification' => $this->getNotification(),
      'compilation' => $this->getCompilation(Auth::id()),
      'news' => $this->getNewsForPage(),
      'adminNews' => $this->getAdminNews(),
      'user' => $this->getUser(),
      'count_houses' => $this->houseService->getCountHouses('Вилла'),
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
      'count' => House::count(),
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
    return response()->json($this->getHouseForUserPagination($request->user_id), 200);
  }

  /**
   * show all house for user
   * @return \Inertia\Response
   */

  public function showHouse()
  {
    $admin = Auth::user()->role > 1 ? true : false;

    if (Auth::user()->role === 1) {
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

  public function getHousesForAdmin(Request $request)
  {
    return response()->json($this->getHouseForAdminPagination(1000), 200);
  }

  /**
   * get count houses
   * @return \Illuminate\Http\JsonResponse
   */

  public function getCountHouse()
  {
    return response()->json(House::count(), 200);
  }

  /**
   * get house api
   * @param Request $request
   * @return \Inertia\Response
   */

  public function getHouseApi(Request $request)
  {
    return $this->house($request->slug);
  }

  /**
   * get jk houses in api
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getHouses(Request $request, HousesService $housesService)
  {
    $validator = Validator::make($request->all(), [
      'type' => 'int|required|min:0|max:1',
      'limit' => 'int|min:0',
      'dop' => 'required',
      'offset' => 'int|min:0'
    ]);

    if($validator->fails()) {
      return response()->json($validator->messages(), 400);
    }

    $type = $request->type == 0 ? "Новостройка" : "Вилла";

    return $housesService->getHouses($type, $request->limit, $request->dop, $request->offset);
  }

  /**
   * get villages in api
   * @param Request $request
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  public function getHousesVillages(Request $request, HousesService $housesService)
  {
    if ($request->isCache) {
      return Cache::get('houses_villages_full');
    } else {
      return $housesService->getHouses('', false, $request->dop, null);
    }
  }

  /**
   * render page for house
   * @param $slug
   * @return \Inertia\Response
   */

  public function house($slug)
  {
    $house = House::where('slug', $slug)
      ->where('user_id', Auth::id())
      ->first();

    if ($house === null) {
      $house = House::where('slug', $slug)
        ->where('active', 2)
        ->where('visible', 1)
        ->firstOrFail();
    }

    HouseView::create([
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
    House::where('slug', $slug)->firstOrFail();

    if (Auth::user()->role === 1) {

      $user = $this->getUser();
      $token = $user->token;

    } else if (Auth::user()->role === 2 || Auth::user()->role === 3) {

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
    House::where('id', $request->house_id)->delete();
    HouseView::where('house_id', $request->house_id)->delete();
    HouseImage::where('house_id', $request->house_id)->delete();
    HouseNew::where('house_id', $request->house_id)->delete();
    HouseCharacteristic::where('house_id', $request->house_id)->delete();
    HouseSupport::where('house_id', $request->house_id)->delete();
    HouseFile::where('house_id', $request->house_id)->delete();
    Frame::where('house_id', $request->house_id)->delete();

    return response()->json(true, 205);
  }

  /**
   * create house and characteristics
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request, HousesService $housesService)
  {
    if ($request->floors && $request->count_flat) {
      $house = House::create([
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

      HouseCharacteristic::create([
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
  }

  /**
   * edit house
   * @param Request $request
   * @param HousesService $housesService
   * @return \Illuminate\Http\JsonResponse
   */

  public function editHouse(Request $request, HousesService $housesService)
  {
    $house = House::where('id', $request->house_id)
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

    HouseCharacteristic::where('house_id', $request->house_id)
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
  }


  /**
   * added support for house
   * @param Request $request
   */

  public function supports(Request $request)
  {
    if ($request->avatar) {
      $imageName = time() . '.support.' . $request->file('image')->getClientOriginalExtension();
      $request->avatar->move(public_path('/storage/support'), $imageName);
    } else {
      $imageName = null;
    }

    HouseSupport::create([
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

    return response()->json(HouseSupport::where('house_id', $request->house_id)->get(), 200);
  }

  /**
   * edit support
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editSupport(Request $request)
  {
    if ($request->avatar !== 'not') {
      $imageName = time() . '.support.' . $request->file('image')->getClientOriginalExtension();
      $request->avatar->move(public_path('/storage/support'), $imageName);
      $imageName = '/storage/support/' . $imageName;
    } else {
      $sup = HouseSupport::where('id', $request->id)->first();
      $imageName = $sup->avatar;
    }

    HouseSupport::where('id', $request->id)
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

    return response()->json(HouseSupport::where('house_id', $request->house_id)->get(), 200);
  }

  /**
   * delete supports with help id
   * @param Request $request
   */

  public function deleteSupport(Request $request)
  {
    return response()->json(HouseSupport::where('id', $request->id)->delete(), 205);
  }

  /**
   * all delete supports
   * @param Request $request
   */

  public function clearSupport(Request $request)
  {
    return response()->json(HouseSupport::where('house_id', $request->house_id)->delete(), 205);
  }

  /**
   * get house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function get(Request $request)
  {
    return response()->json($house = $this->getHouseSlug($this->getHouse($request->id)->slug), 200);
  } //end

  /**
   * edit visible for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function setVisible(Request $request)
  {
    House::where('id', $request->house_id)
      ->update([
        'visible' => $request->visible,
      ]);

    return response()->json(true, 200);
  }

  /**
   * added files for houses
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedFiles(Request $request)
  {
    $fileName = time() . '.files.' . $request->file('file')->getClientOriginalExtension();
    $request->file('file')->move(public_path('/storage/files'), $fileName);

    $file = HouseFile::create([
      'house_id' => $request->house_id,
      'name' => '/storage/files/' . $fileName,
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

    return response()->json($file, 200);
  }

  /**
   * deleted file
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deletedFile(Request $request)
  {
    HouseFile::where('name', $request->fileName)->delete();

    return response()->json(HouseFile::where('house_id', $request->house_id)->get(), 200);
  }

  /**
   * added images for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedImages(Request $request, ImageService $imageService)
  {
      $imageName = time() + rand(1, 100000) . '.house.' . $request->file('image')->getClientOriginalExtension();
      $request->file('image')->move(public_path('/storage/buffer'), $imageName);

      $image = HouseImage::create([
        'house_id' => $request->house_id,
        'name' => '/storage/buffer/' . $imageName,
        'category' => $request->category_id,
      ]);

      \App\Jobs\Image::dispatch(
        $image->id,
        $imageName,
        true
      )->delay(2);

      House::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json($image->name, 200);
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

    if ($blur) {
      $image1 = Image::make('storage/' . $image_buffer);
      $image1->resize(800, 420);
      $image1->blur(50);
      $image1->insert($image, 'center');

      $image1->save($path . $image_buffer, 100);
    } else {

      $image->save($path . $image_buffer, 100);
    }

    unlink('storage/buffer/' . $image_buffer);
  }

  /**
   * deleted image
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function deletedImage(Request $request, ImageService $imageService)
  {
      HouseImage::where('name', $request->image_name)
        ->where('house_id', $request->house_id)
        ->delete();

      House::where('id', $request->house_id)->update([
        'active' => 0,
      ]);

      return response()->json(HouseImage::where('house_id', $request->house_id)->get(), 200);
  }

  public function getInfos()
  {
    return Type::all();
  }

  public function getDops()
  {
    return Structure::all();
  }

  public function getCityes()
  {
    return $this->getCity();
  }
}
