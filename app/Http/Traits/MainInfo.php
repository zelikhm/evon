<?php

namespace App\Http\Traits;

use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseNewsModel;
use App\Models\Builder\HouseViewsModel;
use App\Models\Builder\Info\CityModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use App\Models\Messages\ChatModel;
use App\Models\Messages\MessageModel;
use App\Models\NotificationModel;
use App\Models\User\CompilationModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Routing\Loader\Configurator\collection;

trait MainInfo {

  /**
   * get houses for slider in the page house
   * @param $house
   * @return mixed
   */

  protected function getSlider($house) {

    $requestCity = HouseModel::where('city', $house->city)->whereNot('id', $house->id)->with(['flats'])->get();

    $requestArea = HouseModel::where('area', $house->area)->whereNot('id', $house->id)->with(['flats'])->get();

    if(count($requestCity) > 5) {
    } else {
      $requestCity->merge($requestArea);
    }

    if(count($requestCity) === 0) {
      $requestCity = HouseModel::limit(5)->whereNot('id', $house->id)->with(['flats'])->get();
    }

    $requestCity->splice(5);

    return $requestCity;
  }

  /**
   * check chat
   * @param $id
   * @return mixed
   */

  protected function checkChat($id){
    $chat = ChatModel::where('from_id', $id)
      ->orWhere('to_id', Auth::id())
      ->first();

    if($chat === null) {
      $chat = ChatModel::where('to_id', $id)
        ->orWhere('from_id', Auth::id())
        ->first();
    }

    if($chat === null) {
      $chat = $this->createChat($id);
    }

    return $chat;
  }

  /**
   * create chat for user
   * @param $id
   * @return mixed
   */

  protected function createChat($id) {
    return ChatModel::create([
      'from_id' => Auth::id(),
      'to_id' => $id,
      'visible_id' => $id,
    ]);
  }

  /**
   * get house for user
   * @param $id
   * @return mixed
   */

  protected function getHouseForUser($id) {
    $houses = HouseModel::where('user_id', $id)->with(['info', 'supports', 'files', 'frames', 'images', 'news'])->get();

    foreach ($houses as $house) {
      $house->view = [
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addHour(-24))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-5))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-7))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addWeek(-1))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addYear(-1))->count(),
      ];
    }

    return $houses;
  }

  /**
   * get house for user
   * @param $id
   * @return mixed
   */

  protected function getHouseForUserPagination($id) {
    $houses = HouseModel::where('user_id', $id)->with(['info', 'supports', 'files', 'frames', 'images', 'news'])->paginate(2);

    foreach ($houses as $house) {
      $house->view = [
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addHour(-24))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-5))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addDay(-7))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addWeek(-1))->count(),
        HouseViewsModel::where('house_id', $house->id)->where('created_at', '>', Carbon::now()->addYear(-1))->count(),
      ];
    }

    return $houses;
  }

  /**
   * get all news for user
   * @param $id
   * @return \Symfony\Component\Routing\Loader\Configurator\CollectionConfigurator
   */

  protected function getNews($id) {
    $houses = $this->getHouseForUser($id);

    $news = collect();

    foreach ($houses as $house) {
      $news_array = HouseNewsModel::where('house_id', $house->id)->with(['house'])->get();

      foreach ($news_array as $new) {
        $news->push($new);
      }
    }

    return $news;
  }

  /**
   * get all houses
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  protected function getAllHouse() {
    return HouseModel::where('visible', 1)
      ->where('active', 2)
      ->with(['info', 'supports', 'files', 'frames', 'images'])
      ->get();
  }

  /**
   * get notification
   * @return mixed
   */

  protected function getNotification() {
    $notifications = NotificationModel::where('user_id', Auth::id())->get();

    NotificationModel::where('user_id', Auth::id())->delete();

    return $notifications;
  }

  /**
   * get all chats
   * @return mixed
   */

  protected function getChats() {
   $chats = ChatModel::where('from_id', Auth::id())
     ->orWhere('to_id', Auth::id())
     ->with(['from', 'to'])
     ->get();

   foreach ($chats as $chat) {
     $chat->last_message = MessageModel::where('chat_id', $chat->id)->orderBy('DESC')->first();
   }

   return $chats;
  }

  /**
   * get house
   * @param $id
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouse($id) {
    $house = HouseModel::with(['info', 'supports', 'files', 'frames', 'images', 'user', 'news'])
      ->where('id', $id)
      ->first();

    foreach ($house->frames as $frame) {
      $frame->flats = FlatModel::where('frame_id', $frame->id)->with(['images'])->get();
    }

    return $house;
  }

  /**
   * get house
   * @param $slug
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouseSlug($slug) {
    $house = HouseModel::with(['info', 'supports', 'files', 'frames', 'images', 'user', 'news'])
      ->where('slug', $slug)
      ->first();

    foreach ($house->frames as $frame) {
      $frame->flats = FlatModel::where('frame_id', $frame->id)->with(['images'])->get();
    }

    return $house;
  }

  /**
   * get all compilation
   * @param $id
   * @return mixed
   */

  protected function getCompilations($id) {
    return CompilationModel::where('user_id', $id)->with(['values'])->get();
  }

  /**
   * get one compilation
   * @param $id
   * @return mixed
   */

  protected function getCompilation($id) {
    return CompilationModel::where('id', $id)->with(['values'])->get();
  }


  /**
   * get all dops
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function getDop() {
    return TypesModel::all();
  }

  /**
   * get city and regions
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  protected function getCity() {
    return CityModel::with(['regions'])->get();
  }

  /**
   * get all infos
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function getInfo() {
    return StructureModel::all();
  }
}
