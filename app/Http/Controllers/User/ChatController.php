<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\Messages\ChatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    use MainInfo;

    public function index(Request $request) {

      if($request->chat_id) {
        $chat = ChatModel::where('id', $request->chat_id)
          ->orWhere('from_id', Auth::id())
          ->orWhere('to_id', Auth::id())
          ->with(['messages', 'from', 'to'])
          ->firstOrFail();
      } else {
        $chat = null;
      }

      $chats = ChatModel::orWhere('from_id', Auth::id())
        ->orWhere('to_id', Auth::id())
        ->with(['messages', 'from', 'to'])
        ->get();

      return Inertia::render('AppChat', [
        'chats' => $chats,
        'chat' => $chat,
        'notification' => $this->getNotification(),
      ]);

    }
}
