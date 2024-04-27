<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Log\PaymentLog;
use App\Models\Payment;
use App\Models\Tarif;
use App\Models\User;
use App\Models\User\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
  /**
   * Paytr method
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse|string
   * @throws \Exception
   */

  public function payment(Request $request)
  {

    info($request->callback_id);

    $payment = Payment::where('id', $request->callback_id)
      ->where('status', 0)
      ->first();

    Payment::where('id', $request->callback_id)
      ->update(['status' => 1]);

    if ($request->status === 'success' && $payment !== null) {

      $type = Tarif::where('id', $payment->type)->first();

      info($type->days);

      $user = User::where('email', $payment->email)->first();

      return $this->setSubscription($user, $type);
    } else {
      return "OK";
    }

  }

  /**
   * create log
   * @param $user_id
   * @param $text
   */

  private function setLog($user_id, $text) {

    PaymentLog::create([
      'user_id' => $user_id,
      'text' => $text
    ]);

  } //end

  /**
   * main method for set subscription for users
   * @param $user
   * @param $type
   * @return \Illuminate\Http\JsonResponse
   * @throws \Exception
   */

  public function setSubscription($user, $type)
  {

    self::setLog($user->id, 'Инициализация подписки');

    $sub = Subscription::where('user_id', $user->id)->first();

    if ($sub !== null) {
      if ($sub->finished_at < Carbon::now()->addHour(3)) {

        self::setLog($user->id, 'Продление закончившейся подписки (1)');

        $sub = Subscription::where('user_id', $user->id)->update([
          'finished_at' => Carbon::now()->addHour(3)->addDay($type->days),
          'free' => 0,
        ]);

        try {
          self::setLog($user->id, 'Успешное продление (1)');
        } catch (\Exception $exception) {
          self::setLog($user->id, 'Неудачное продление (1):' . $exception);
        }

      } else {

        if ($sub->free === 1) {

          self::setLog($user->id, 'Продление бесплатной подписки (2)');

          $sub = Subscription::where('user_id', $user->id)->update([
            'finished_at' => Carbon::now()->addHour(3)->addDay($type->days),
            'free' => 0,
          ]);

          try {
            self::setLog($user->id, 'Успешное продление (2)');
          } catch (\Exception $exception) {
            self::setLog($user->id, 'Неудачное продление (2):' . $exception);
          }

        } else {
          $date = new Carbon($sub->finished_at);

          self::setLog($user->id, 'Продление подписки (3)');

          $sub = Subscription::where('user_id', $user->id)->update([
            'finished_at' => $date->addDay($type->days),
            'free' => 0,
          ]);

          try {
            self::setLog($user->id, 'Успешное продление (3)');
          } catch (\Exception $exception) {
            self::setLog($user->id, 'Неудачное продление (3):' . $exception);
          }
        }
      }

      return response()->json(['message' => 'thanks, subscription was updated', 'status' => 'SUCCESS', 'subscription' => $sub], 200);
    } else {

      self::setLog($user->id, 'Оформление новой подписки (4)');

      $sub = Subscription::create([
        'user_id' => $user->id,
        'active' => true,
        'free' => 0,
        'finished_at' => Carbon::now()->addHour(3)->addDay($type->days),
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      try {
        self::setLog($user->id, 'Успешное оформление (4)');
      } catch (\Exception $exception) {
        self::setLog($user->id, 'Неудачное оформление (4):' . $exception);
      }

      return response()->json(['message' => 'thanks, subscription was created', 'status' => 'SUCCESS', 'subscription' => $sub], 200);

    }


  }
}
