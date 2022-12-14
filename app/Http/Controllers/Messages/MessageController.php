<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Traits\MainInfo;
use App\Models\Messages\ChatModel;
use App\Models\Messages\MessageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
  use MainInfo;

    public function index() {
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

    public function chat($id) {

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

      $messages = MessageModel::where('chat_id', $chat->id)->get();

      return Inertia::render('', [
        'chat' => $chat,
        'messages' => $messages,
        'chats' => $this->getChats(),
        'user' => Auth::user(),
      ]);
    }

  /**
   * save message
   * @param Request $request
   */

    public function message(Request $request) {
      if($request->token === env('TOKEN')) {
        MessageModel::create([
          'chat_id' => $request->chat_id,
          'message' => $request->message,
        ]);

        $notif = new NotificationController();
        $notif->setNotification($request->user_id, 'Вам пришло новое сообщение');

        return response()->json(true, 200);
      } else {
        return response()->json('not auth', 401);
      }

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
}
