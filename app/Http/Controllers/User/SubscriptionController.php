<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentModel;
use App\Models\TarifModel;
use App\Models\User;
use App\Models\User\SubscriptionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function payment(Request $request) {

      info($request->callback_id);

      $payment = PaymentModel::where('id', $request->callback_id)
        ->where('status', 0)
        ->first();

      PaymentModel::where('id', $request->callback_id)
        ->update(['status' => 1]);

      if($request->status === 'success' && $payment !== null) {

        $type = TarifModel::where('id', $payment->type)->first();

        $user = User::where('email', $payment->email)->first();

        $sub = SubscriptionModel::where('user_id', $user->id)->first();

        if($sub !== null) {
          if($sub->finished_at < Carbon::now()->addHour(3)) {

            $sub = SubscriptionModel::where('user_id', $user->id)->update([
              'finished_at' => Carbon::now()->addHour(3)->addDay($type->days),
            ]);

          } else {

            $date = new Carbon($sub->finished_at);

            $sub = SubscriptionModel::where('user_id', $user->id)->update([
              'finished_at' => $date->addDay($type->days),
            ]);
          }

          return response()->json(['message' => 'thanks, subscription was updated', 'status' => 'SUCCESS', 'subscription' => $sub], 200);
        } else {

          $sub = SubscriptionModel::create([
            'user_id' => $user->id,
            'active' => true,
            'finished_at' => Carbon::now()->addHour(3)->addDay($type->days),
            'created_at' => Carbon::now()->addHour(3),
            'updated_at' => Carbon::now()->addHour(3),
          ]);

          return response()->json(['message' => 'thanks, subscription was created', 'status' => 'SUCCESS', 'subscription' => $sub], 200);

        }
      } else {
        return false;
      }
    }
}
