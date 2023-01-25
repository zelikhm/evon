<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\SubscriptionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function payment(Request $request) {

      $sub = SubscriptionModel::where('user_id', $request->user_id)->first();

      if($sub !== null) {
        if($sub->finished_at < Carbon::now()->addHour(3)) {

        $sub = SubscriptionModel::where('user_id', $request->user_id)->update([
          'finished_at' => Carbon::now()->addHour(3)->addDay($request->day),
        ]);

        } else {

          $date = new Carbon($sub->finished_at);

          $sub = SubscriptionModel::where('user_id', $request->user_id)->update([
            'finished_at' => $date->addDay($request->day),
          ]);
        }

        return response()->json(['message' => 'thanks, subscription was updated', 'status' => 'SUCCESS', 'subscription' => $sub], 200);
      } else {

        $sub = SubscriptionModel::create([
          'user_id' => $request->user_id,
          'active' => true,
          'finished_at' => Carbon::now()->addHour(3)->addDay($request->day),
          'created_at' => Carbon::now()->addHour(3),
          'updated_at' => Carbon::now()->addHour(3),
        ]);

        return response()->json(['message' => 'thanks, subscription was created', 'status' => 'SUCCESS', 'subscription' => $sub], 200);

      }




    }
}
