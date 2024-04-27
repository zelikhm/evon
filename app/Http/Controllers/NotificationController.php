<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  /**
   * set notification
   * @param $user_id
   * @param $message
   */

  public function setNotification($user_id, $message)
  {
    Notification::create([
      'user_id' => $user_id,
      'message' => $message,
      'active' => 1,
    ]);
  }

  /**
   * get all notif
   * @return mixed
   */

  public function get() {
    return Notification::where('user_id', Auth::id())
      ->get();
  }

  /**
   * delete notif
   * @param Request $request
   */

  public function delete(Request $request)
  {
    Notification::where('id', $request->id)
      ->delete();
  }
}
