<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentModel;
use App\Models\TarifModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{

  public function plan() {
    return response()->json(TarifModel::all(), 200);
  }

  public function index(Request $request) {
    $merchant_id    = '332444';
    $merchant_key   = '5B9J78CdGoFtpxJ6';
    $merchant_salt  = '9qHpXbz7gSRo8m6F';

    PaymentModel::create([
      'email' => $request->email,
      'type' => $request->type,
    ]);

    $count = PaymentModel::count();

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
    $callback_id        = $count;
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

