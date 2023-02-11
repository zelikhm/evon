<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ChatController;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Messages\ChatModel;
use App\Models\Messages\MessageModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
  use MainInfo;
  use AuthCheck;

  public function index()
  {
    return Inertia::render('chats', [
      'chats' => $this->getChats(),
      'user' => Auth::user(),
      'notification' => $this->getNotification(),
    ]);
  }

  /**
   * render page for chat
   * @param $id
   */

  public function chat($id)
  {

    $chat = $this->checkChat($id);

    $messages = MessageModel::where('chat_id', $chat->id)->get();

    return Inertia::render('', [
      'chat' => $chat,
      'messages' => $messages,
      'chats' => $this->getChats(),
      'user' => Auth::user(),
    ]);
  }

  /**
   * reload chats
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function reloadChats(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      return response()->json([
        'notification' => $this->getNotification(),
        'chats' => $this->getChats(),
      ]);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * reload chat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function reloadChat(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      $chat = $this->checkChat($request->id);

      $messages = MessageModel::where('chat_id', $chat->id)->get();

      return response()->json([
        'notification' => $this->getNotification(),
        'chats' => $this->getChats(),
        'chat' => $chat,
        'messages' => $messages,
      ]);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * save message
   * @param Request $request
   */

  public function message(Request $request)
  {
    if ($this->checkToken($request->token)) {
      MessageModel::create([
        'chat_id' => $request->chat_id,
        'message' => $request->message,
        'user_id' => $request->user_id,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

      $notif = new NotificationController();
      $notif->setNotification($request->user_id, 'Вам пришло новое сообщение');

      $chat = ChatModel::where('id', $request->chat_id)
        ->with(['messages', 'from', 'to'])
        ->first();

      $method = new ChatController();
      $chat->message = $method->loadMessages($chat);

      return response()->json($chat, 200);
    } else {
      return response()->json('not auth', 401);
    }

  }


}
