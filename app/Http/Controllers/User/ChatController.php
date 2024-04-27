<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Messages\Chat;
use App\Models\Messages\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
  use MainInfo, AuthCheck;

  /**
   * get or create chat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getOrCreateChat(Request $request) {

    if ($request->from && $request->to) {
      $chat = Chat::where('from_id', $request->from)
        ->where('to_id', $request->to)
        ->first();

      if ($chat === null) {
        $chat = Chat::where('from_id', $request->to)
          ->where('to_id', $request->from)
          ->first();

        if ($chat === null) {

          $chat = Chat::create([
            'from_id' => $request->from,
            'to_id' => $request->to,
          ]);
        }
      }
    }

    return response()->json($chat, 200);

  }

  /**
   * index method for load or create chat
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */

  public function index(Request $request)
  {

    if ($request->from && $request->to) {
      $chat = Chat::where('from_id', $request->from)
        ->where('to_id', $request->to)
        ->first();

      if ($chat === null) {
        $chat = Chat::where('from_id', $request->to)
          ->where('to_id', $request->from)
          ->first();

        if ($chat === null) {

          $chat = Chat::create([
            'from_id' => $request->from,
            'to_id' => $request->to,
          ]);
        }
      }
    }

    return redirect()->to('/profile/chat/' . $chat->id);

  }

  /**
   * check chat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function checkChatApi(Request $request)
  {

    $chats = Chat::where('visible_id', $request->user_id)
      ->count();

    return response()->json($chats, 200);

  }

  /**
   * get chats
   * @return \Inertia\Response|mixed
   */

  public function getChats()
  {

    $chats = $this->getChatsInfo(Auth::id());

    foreach ($chats as $item) {

      $item->message = Message::where('chat_id', $item->id)
        ->orderBy('created_at', 'DESC')->first();

    }

    return Inertia::render('AppChat', [
      'user' => $this->getUser(),
      'chats' => $chats,
      'chat' => null,
      'notification' => $this->getNotification(),
    ]);

  }

  /**
   * get chats for api
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getChatsApi(Request $request) {

    if($this->checkToken($request->token)) {
      $chats = $this->getChatsInfo($request->user_id);

      foreach ($chats as $item) {

        $item->message = Message::where('chat_id', $item->id)
          ->orderBy('created_at', 'DESC')->first();

      }

      return response()->json($chats, 200);
    } else {
      return response()->json('not auth', 401);
    }


  }

  /**
   * get chat
   * @param $id
   * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
   */

  public function getChat($id)
  {

    $chat = Chat::where('id', $id)
      ->with(['from', 'to'])
      ->firstOrFail();

    if ($chat->from_id !== Auth::id() && $chat->to_id != Auth::id()) {
      return redirect()->to('404');
    }

    $chat->message = $this->loadMessages($chat);

    $chats = $this->getChatsInfo(Auth::id());

    foreach ($chats as $item) {

      $item->message = Message::where('chat_id', $item->id)
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
   * get chat for api
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getChatApi(Request $request) {

    if($this->checkToken($request->token)) {
      $chat = Chat::where('id', $request->chat_id)
        ->with(['from', 'to'])
        ->firstOrFail();

      $chat->message = $this->loadMessages($chat);

//    $chats = $this->getChatsInfo($request->user_id);
//
//    foreach ($chats as $item) {
//
//      $item->message = Message::where('chat_id', $item->id)
//        ->orderBy('created_at', 'DESC')->first();
//
//    }

      return response()->json($chat, 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * get chats info
   * @param $id
   * @return mixed
   */

  public function getChatsInfo($id)
  {
    $moderation = User::where('role', 2)->first();

    $status = Chat::where('from_id', $moderation->id)
      ->where('to_id', $id)
      ->first();

    if ($status === null) {
      $status = Chat::where('to_id', $moderation->id)
        ->where('from_id', $id)
        ->first();

      if ($status === null) {

        if($moderation->id !== $id) {
          Chat::create([
            'from_id' => $moderation->id,
            'to_id' => $id,
            'type' => 1,
          ]);
        }

      }
    }

    $chats = Chat::orWhere('from_id', $id)
      ->orWhere('to_id', $id)
      ->orderBy('type', 'DESC')
      ->orderBy('updated_at', 'DESC')
      ->with(['from', 'to'])
      ->get();

    return $chats;
  }

  /**
   * load message for chats
   * @param $chat
   * @return array
   */

  public function loadMessages($chat)
  {

    $messages = Message::where('chat_id', $chat->id)
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
