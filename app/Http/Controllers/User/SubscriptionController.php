<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TarifModel;
use App\Models\User;
use App\Models\User\SubscriptionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function payment(Request $request) {

      info(1);

      User::where('id', 3)->update(['description' => $request->status]);

      if($request->status === 'success') {

        $type = TarifModel::where('id', $request->callback_id)->first();

        $sub = SubscriptionModel::where('email', $request->email)->first();

        if($sub !== null) {
          if($sub->finished_at < Carbon::now()->addHour(3)) {

            $sub = SubscriptionModel::where('email', $request->email)->update([
              'finished_at' => Carbon::now()->addHour(3)->addDay($type->days),
            ]);

          } else {

            $date = new Carbon($sub->finished_at);

            $sub = SubscriptionModel::where('email', $request->email)->update([
              'finished_at' => $date->addDay($type->days),
            ]);
          }

          return response()->json(['message' => 'thanks, subscription was updated', 'status' => 'SUCCESS', 'subscription' => $sub], 200);
        } else {

          $sub = SubscriptionModel::create([
            'email' => $request->email,
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
