<?php

namespace App\Http\Traits;

use App\Http\Admin\News\AdminNews;
use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\HouseCharacteristic;
use App\Models\Builder\HouseImage;
use App\Models\Builder\House;
use App\Models\Builder\HouseNew;
use App\Models\Builder\HouseView;
use App\Models\Builder\Info\City;
use App\Models\Builder\Info\Region;
use App\Models\Builder\Info\Structure;
use App\Models\Builder\Info\Type;
use App\Models\Messages\Chat;
use App\Models\Messages\Message;
use App\Models\Notification;
use App\Models\User;
use App\Models\User\CompilationInfo;
use App\Models\User\Compilation;
use App\Models\User\Favorite;
use App\Models\User\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Routing\Loader\Configurator\collection;

trait MainInfo
{

  private $type;

  /**
   * get houses for slider in the page house
   * @param $house
   * @return mixed
   */

  protected function getSlider($house)
  {

    $requestArea = House::where('area', $house->area)
      ->whereNot('id', $house->id)
      ->where('active', 2)
      ->where('visible', 1)
      ->with(['flats', 'mainImage'])->get();

    $requestArea->splice(5);

    foreach($requestArea as $item) {
      $item->image = $this->getPhoto($item);
    }

    return $requestArea;
  }

  /**
   * get user
   * @return mixed
   */

  protected function getUser()
  {

    $user = User::where('id', Auth::id())
      ->with(['company', 'subscriptionInfo', 'verification'])
      ->first();

    if ($user !== null) {
      $user->subscription = $user->hasSubscription();
    } else {
      $user = [];
    }


    return $user;

  }

  /**
   * get last 20 news
   * @return mixed
   */

  protected function getNewsForPage()
  {
    $news = HouseNew::orderByDesc('created_at')
      ->with(['house'])->get();

    foreach ($news as $key => $item) {

      if ($item->house->visible === 0 || $item->house->active !== 2) {
        $news[$key] = [];
      }

    }

    return $news;
  }

  /**
   * get 20 last admin news
   * @return mixed
   */

  protected function getAdminNews()
  {
    return \App\Models\News\AdminNew::orderByDesc('created_at')->limit(30)->get();
  }

  /**
   * get compilation for user
   * @param $id
   * @return mixed
   */

  protected function getCompilation($id)
  {
    $compilation = Compilation::where('user_id', $id)->get();

    foreach ($compilation as $item) {
      $houses = collect();
      $comp = CompilationInfo::where('compilation_id', $item->id)->with(['house'])->get();
      foreach ($comp as $value) {
        $houses->push($value);
      }
      $item->houses = $houses;
    }

    return $compilation;
  }

  /**
   * check chat
   * @param $id
   * @return mixed
   */

  protected function checkChat($id)
  {
    $chat = Chat::where('from_id', $id)
      ->orWhere('to_id', Auth::id())
      ->first();

    if ($chat === null) {
      $chat = Chat::where('to_id', $id)
        ->orWhere('from_id', Auth::id())
        ->first();
    }

    if ($chat === null) {
      $chat = $this->createChat($id);
    }

    return $chat;
  }

  /**
   * create chat for user
   * @param $id
   * @return mixed
   */

  protected function createChat($id)
  {
    return Chat::create([
      'from_id' => Auth::id(),
      'to_id' => $id,
      'visible_id' => $id,
    ]);
  }

  /**
   * get house on house id
   * @param $house_id
   * @return mixed
   */

  protected function getHouseOnId($house_id)
  {
    $house = House::where('id', $house_id)->with(['flats', 'user', 'mainImage'])->first();


    if ($house !== null) {
      if($house->mainImage === null) {
        $house->image = HouseImage::where('house_id', $house->id)->first();
      } else {
        $house->image = $house->mainImage;
      }

      return $house;
    }
  }

  /**
   * get main photo for house
   * @param $house
   * @return mixed
   */

  protected function getPhoto($house)
  {

    if($house->mainImage !== null) {
      return $house->mainImage->isResize === 1 ? (env('SERVICE_URL') . '/' . $house->mainImage->image) : $house->mainImage->image;
    }

    $image = HouseImage::where('house_id', $house->id)
      ->orderBy('category', 'ASC')
      ->orderBy('created_at', 'ASC')
      ->first();

    if ($image !== null) {
      return $image->isResize === 1 ? ((env('SERVICE_URL') . $image->name)) : $image->name;
    }
  }

  protected function getPhotos($house)
  {

    $array = collect();

    for ($i = 0; $i < 4; $i++) {

      $images = HouseImage::where('house_id', $house->id)->where('category', $i)->limit(5)->get();

      foreach ($images as $image) {
        $array->push($image);
      }
    }

    return $array;

  }

  /**
   * get house for user
   * @param $user_id
   * @return mixed
   */

  protected function getHouseForUser($user_id)
  {
    $houses = House::where('user_id', $user_id)->with(['info', 'supports', 'files', 'frames', 'images', 'news'])->get();

    foreach ($houses as $house) {
      $house->image = $this->getPhoto($house);
      $house->view = [
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addHour(-24))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-5))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-7))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addWeek(-1))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addYear(-1))->count(),
      ];
    }

    return $houses;
  }

  /**
   * get house for user
   * @param $id
   * @return mixed
   */

  protected function getHouseForUserPagination($id)
  {
    $houses = House::where('user_id', $id)->with(['info', 'supports', 'files', 'frames', 'images', 'news'])->get();

    foreach ($houses as $house) {
      $house->image = $this->getPhoto($house);

      $house->view = [
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addHour(-24))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-5))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-7))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addWeek(-1))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addYear(-1))->count(),
      ];
    }

    return $houses;
  }

  /**
   * getHouses
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  protected function getHouseForAdminPagination($limit) {
    $houses = House::with(['info', 'supports', 'files', 'frames', 'images', 'news'])->limit($limit)->get();

    foreach ($houses as $house) {
      $house->image = $this->getPhoto($house);

      $house->view = [
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addHour(-24))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-5))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-7))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addWeek(-1))->count(),
        HouseView::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addYear(-1))->count(),
      ];
    }

    return $houses;
  }

  /**
   * get all news for user
   * @param $id
   * @return \Illuminate\Support\Collection
   */

  protected function getNews($id)
  {
    $houses = $this->getHouseForUser($id);

    $news = collect();

    foreach ($houses as $house) {
      $news_array = HouseNew::where('house_id', $house->id)->with(['house'])->get();

      foreach ($news_array as $new) {
        $news->push($new);
      }
    }

    return $news;
  }

  /**
   * get notification
   * @return mixed
   */

  protected function getNotification()
  {
    $notifications = Notification::where('user_id', Auth::id())->get();

    Notification::where('user_id', Auth::id())->delete();

    return $notifications;
  }

  /**
   * get all chats
   * @return mixed
   */

  protected function getChats()
  {
    $chats = Chat::where('from_id', Auth::id())
      ->orWhere('to_id', Auth::id())
      ->with(['from', 'to'])
      ->get();

    foreach ($chats as $chat) {
      $chat->last_message = Message::where('chat_id', $chat->id)->orderBy('DESC')->first();
    }

    return $chats;
  }

  /**
   * get house
   * @param $id
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouse($id)
  {
    $house = House::with(['info', 'supports', 'files', 'frames', 'user', 'news', 'images', 'flats'])
      ->where('id', $id)
      ->first();

    foreach ($house->frames as $frame) {
      $frame->flats = Flat::where('frame_id', $frame->id)->with(['images'])->get();
    }

    $house->image = $this->getPhoto($house);

    $favorite = Favorite::where('user_id', Auth::id())
      ->where('house_id', $id)
      ->first();

    if ($favorite === null) {
      $house->favorite = false;
    } else {
      $house->favorite = true;
    }


    return $house;
  }

  /**
   * get house
   * @param $slug
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouseSlug($slug)
  {
    $house = House::with(['info', 'supports', 'files', 'frames', 'images', 'user', 'news', 'flats', 'city_object', 'mainImage'])
      ->where('slug', $slug)
      ->first();

    if (count($house->flats) > 0) {
      $flats = $house->flats;

      $flats->sortBy(
        [
          fn($a, $b) => $a->updated_at <=> $b->updated_at,
          fn($a, $b) => $b->updated_at <=> $a->updated_at,
        ]
      );

      $house->flat_updated = $flats[0]->updated_at->format('d-m-Y');
    } else {
      $house->flat_updated = null;
    }

    $frame_updated = Frame::where('house_id', $house->id)->orderBy('updated_at', 'DESC')->first();

    if ($frame_updated !== null) {
      $house->frame_updated = $frame_updated->updated_at->format('d-m-Y');
    } else {
      $house->frame_updated = null;
    }

    foreach ($house->frames as $frame) {
      $frame->flats = Flat::where('frame_id', $frame->id)->with(['images'])->get();
    }

    $house->image = $this->getPhoto($house);

    $house->maxPrice = $house->flats->max('price');
    $house->minPrice = $house->flats->min('price');

    $house->maxSquare = $house->flats->max('square');
    $house->minSquare = $house->flats->min('square');

    $favorite = Favorite::where('user_id', Auth::id())
      ->where('house_id', $house->id)
      ->first();

    if ($favorite === null) {
      $house->favorite = false;
    } else {
      $house->favorite = true;
    }

    return $house;
  }

  /**
   * get all compilation
   * @param $id
   * @return mixed
   */

  protected function getCompilations($id)
  {
    $compilations = Compilation::where('user_id', $id)->with(['values'])->get();

    foreach ($compilations as $compilation) {
      foreach ($compilation->values as $value) {
        $value->house = $this->getHouseOnId($value->house_id);
      }
    }

    return $compilations;

  }

  /**
   * get one compilation
   * @param $id
   * @return mixed
   */

//  protected function getCompilation($id) {
//    return Compilation::where('id', $id)->with(['values'])->get();
//  }


  /**
   * get all dops
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function getDop()
  {
    return Type::all();
  }

  /**
   * get city and regions
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  protected function getCity()
  {
    return City::with(['regions'])->get();
  }

  /**
   * get areas
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function getRegions() {
    return Region::all();
  }

  /**
   * get all infos
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function getInfo()
  {
    return Structure::all();
  }
}
