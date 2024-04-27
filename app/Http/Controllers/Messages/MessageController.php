<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ChatController;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Messages\Chat;
use App\Models\Messages\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
  use MainInfo;
  use AuthCheck;

  private $method;

  public function index()
  {
    return Inertia::render('chats', [
      'chats' => $this->getChats(),
      'user' => Auth::user(),
      'notification' => $this->getNotification(),
    ]);
  }

  public function __construct()
  {
    $this->method = new ChatController();
  }

  /**
   * render page for chat
   * @param $id
   */

  public function chat($id)
  {

    $chat = $this->checkChat($id);

    $messages = Message::where('chat_id', $chat->id)->get();

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
    if ($this->checkToken($request->token)) {

      $chats = new ChatController();
      $chats = $chats->getChatsInfo($request->user_id);

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
   * reload chat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function reloadChat(Request $request)
  {
    if ($this->checkToken($request->token)) {
      $chat = Chat::where('id', $request->id)
        ->with(['messages', 'from', 'to'])
        ->first();

      $chat->message = $this->method->loadMessages($chat);

      return response()->json($chat, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * open chat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function chatOpen(Request $request) {

    Chat::where('id', $request->id)->update(['visible_id' => 0]);

    return response()->json(true, 200);

  }

  /**
   * save message
   * @param Request $request
   */

  public function message(Request $request)
  {
    if ($this->checkToken($request->token)) {
      Message::create([
        'chat_id' => $request->chat_id,
        'message' => $request->message,
        'user_id' => $request->user_id,
        'created_at' => Carbon::now()->addHours(6),
        'updated_at' => Carbon::now()->addHours(6),
      ]);

      Chat::where('id', $request->chat_id)->update([
        'visible_id' => $request->visible_id,
        'updated_at' => Carbon::now()->addHours(6),
      ]);

      $notif = new NotificationController();
      $notif->setNotification($request->user_id, 'Вам пришло новое сообщение');

      $chat = Chat::where('id', $request->chat_id)
        ->with(['messages', 'from', 'to'])
        ->first();

      $chat->message = $this->method->loadMessages($chat);

      return response()->json($chat, 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

}
