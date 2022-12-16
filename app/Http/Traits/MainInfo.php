<?php

namespace App\Http\Traits;

use App\Models\Builder\HouseModel;
use App\Models\Builder\Info\CityModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use App\Models\Messages\ChatModel;
use App\Models\Messages\MessageModel;
use App\Models\NotificationModel;
use App\Models\User\CompilationModel;
use Illuminate\Support\Facades\Auth;

trait MainInfo {

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
   * get all houses
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  protected function getAllHouse() {
    return HouseModel::with(['info', 'supports', 'files', 'frames', 'images'])->get();
  }

  /**
   * get notification
   * @return mixed
   */

  protected function getNotification() {
    return NotificationModel::where('user_id', Auth::id());
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
    return HouseModel::with(['info', 'supports', 'files', 'frames', 'images'])
      ->where('id', $id)
      ->first();
  }

  /**
   * get house
   * @param $slug
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouseSlug($slug) {
    return HouseModel::with(['info', 'supports', 'files', 'frames', 'images'])
      ->where('slug', $slug)
      ->first();
  }

  /**
   * get all compilation
   * @param $id
   * @return mixed
   */

  protected function getCompilation($id) {
    return CompilationModel::where('user_id', $id)->with(['values'])->get();
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
