<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\Messages\ChatModel;
use App\Models\Messages\MessageModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
  use MainInfo;

  public function index(Request $request)
  {

    if ($request->from && $request->to) {
      $chat = ChatModel::where('from_id', $request->from)
        ->where('to_id', $request->to)
        ->first();

      if ($chat === null) {
        $chat = ChatModel::where('from_id', $request->to)
          ->where('to_id', $request->from)
          ->first();

        if ($chat === null) {

          $chat = ChatModel::create([
            'from_id' => $request->from,
            'to_id' => $request->to,
          ]);
        }
      }
    }

    return redirect()->to('/profile/chat/' . $chat->id);

  }

  public function checkChatApi(Request $request)
  {

    $chats = ChatModel::where('visible_id', $request->user_id)
      ->count();

    return response()->json($chats, 200);

  }

  public function getChats()
  {

    $chats = $this->getChatsInfo(Auth::id());

    foreach ($chats as $item) {

      $item->message = MessageModel::where('chat_id', $item->id)
        ->orderBy('created_at', 'DESC')->first();

    }

    return Inertia::render('AppChat', [
      'user' => $this->getUser(),
      'chats' => $chats,
      'chat' => null,
      'notification' => $this->getNotification(),
    ]);

  }

  public function getChat($id)
  {

    $chat = ChatModel::where('id', $id)
      ->with(['from', 'to'])
      ->firstOrFail();

    if ($chat->from_id !== Auth::id() && $chat->to_id != Auth::id()) {
      return redirect()->to('404');
    }

    $chat->message = $this->loadMessages($chat);

    $chats = $this->getChatsInfo(Auth::id());

    foreach ($chats as $item) {

      $item->message = MessageModel::where('chat_id', $item->id)
        ->orderBy('created_at', 'DESC')->first();

    }

    return Inertia::render('AppChat', [
      'user' => $this->getUser(),
      'chats' => $chats,
      'chat' => $chat,
      'notification' => $this->getNotification(),
    ]);

  }

  /**
   * get chats info
   * @param $id
   * @return mixed
   */

  public function getChatsInfo($id)
  {
    $moderation = User::where('role', 2)->first();

    $status = ChatModel::where('from_id', $moderation->id)
      ->where('to_id', $id)
      ->first();

    if ($status === null) {
      $status = ChatModel::where('to_id', $moderation->id)
        ->where('from_id', $id)
        ->first();

      if ($status === null) {

        if($moderation->id !== $id) {
          ChatModel::create([
            'from_id' => $moderation->id,
            'to_id' => $id,
            'type' => 1,
          ]);
        }

      }
    }

    $chats = ChatModel::orWhere('from_id', $id)
      ->orWhere('to_id', $id)
      ->orderBy('type', 'DESC')
      ->orderBy('updated_at', 'DESC')
      ->with(['from', 'to'])
      ->get();

    return $chats;
  }

  public function loadMessages($chat)
  {

    $messages = MessageModel::where('chat_id', $chat->id)
      ->orderBy('created_at', 'ASC')
      ->get();

    $array = [];

    foreach ($messages as $message) {
      $date = Carbon::create($message->updated_at);

      if (count($array) === 0) {


        $array[$date->toDateString()] = [$message];

      } else {

        if (array_key_exists($date->toDateString(), $array)) {
          array_push($array[$date->toDateString()], $message);
        } else {
          $array[$date->toDateString()] = [$message];
        }

      }

    }

    krsort($array, SORT_REGULAR);

    return $array;

  }
}
