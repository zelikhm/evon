<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SubscriptionController;
use App\Models\Payment;
use App\Models\Tarif;
use App\Models\TarifRussion;
use App\Models\Trace;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class IndexController extends Controller
{

  public function plan() {
    return response()->json(Tarif::all(), 200);
  }

  /**
   * cloud success payment
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */

  public function cloud(Request $request) {

     Trace::create([
      'user_id' => $request->options['data']['CloudPayments']['user_id'],
      'order_id' => $request->options['data']['CloudPayments']['random'],
      'price' => $request->options['data']['CloudPayments']['Amounts'],
      'title' => 'Оплата русской подписки',
      'status' => 'Оплачено',
      'type' => $request->options['data']['CloudPayments']['TypeAdmin'],
    ]);

    $tarif = TarifRussion::where('id', $request->options['data']['CloudPayments']['TypeAdmin'])->first();
    $user = User::where('id', $request->options['data']['CloudPayments']['user_id'])->first();

    $subscription = new SubscriptionController();
    $subscription->setSubscription($user, $tarif);

    return Inertia::location('/profile');

  }

  /**
   * set failed subscription
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function setFailed(Request $request) {

    Trace::create([
      'user_id' => $request->options['data']['CloudPayments']['user_id'],
      'order_id' => $request->options['data']['CloudPayments']['random'],
      'price' => $request->options['data']['CloudPayments']['Amounts'],
      'title' => 'Оплата русской подписки',
      'status' => 'Оплачено',
      'type' => $request->options['data']['CloudPayments']['TypeAdmin'],
    ]);

    return Inertia::location('/profile');
  }

  /**
   * paytr generation link for payment
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function index(Request $request) {
    $merchant_id    = '332444';
    $merchant_key   = '5B9J78CdGoFtpxJ6';
    $merchant_salt  = '9qHpXbz7gSRo8m6F';

    Payment::create([
      'email' => $request->email,
      'type' => $request->type,
    ]);

    $count = Payment::orderBy('id', 'DESC')->first();

    $name            = "подписка: для пользователя " . $request->email;
    $price           = $request->price;
    $currency        = "TL";
    $max_installment = "12";
    $link_type       = "product";
    $lang            = "tr";
    $get_qr          = 1;
    $required        = $name.$price.$currency.$max_installment.$link_type.$lang;

    if($link_type == "product"){
      $min_count     = "1";

      $required     .= $min_count;
    }elseif($link_type == "collection"){
      $email         = time().$request->email;

      $required     .= $request->email;
    }

    $expiry_date        = Carbon::now()->addDay();
    $max_count          = "1";
    $callback_link      = "https://evon-tr.com/api/payment/success";
    $callback_id        = $count->id;
    $debug_on           = 1;

    $paytr_token=base64_encode(hash_hmac('sha256', $required.$merchant_salt, $merchant_key, true));

    $post_vals=array(
      'merchant_id'       => $merchant_id,
      'name'              => $name,
      'price'             => $price,
      'currency'          => $currency,
      'max_installment'   => $max_installment,
      'link_type'         => $link_type,
      'lang'              => $lang,
      'min_count'         => $min_count,
      'email'             => $request->email,
      'expiry_date'       => $expiry_date,
      'max_count'         => $max_count,
      'callback_link'     => $callback_link,
      'callback_id'       => $callback_id,
      'debug_on'          => $debug_on,
      'get_qr'            => $get_qr,
      'paytr_token'       => $paytr_token
    );

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/link/create");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1) ;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = @curl_exec($ch);
//    return response()->json($result, 201);
    if(curl_errno($ch))
      die("PAYTR LINK CREATE API request timeout. err:".curl_error($ch));

    curl_close($ch);

    $result = json_decode($result,1);

    if($result === null) {
      return response()->json($result, 201);
    }

    return response()->json($result['link'], 200);
  }

}

