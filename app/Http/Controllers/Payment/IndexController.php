<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{

  private $merchant_id    = '332444';
  private $merchant_key   = '5B9J78CdGoFtpxJ6';
  private $merchant_salt  = '9qHpXbz7gSRo8m6F';

  private $currency = 'TL';
  private $link_type = 'product';
  private $lang = 'tr';
  private $min_count = 1;
  private $max_installment = "12";

//  public function index(Request $request) {
//
//    $name = "Nikita Zelikov";
//
//    $email = 'boss.Zelikov99@gmail.com';
//
//    $price = 1445;
//
//    $required = $name.$price.$this->currency.$this->max_installment.$this->link_type.$this->lang.$this->min_count;
//
//    $paytr_token = base64_encode(hash_hmac('sha256', $required.$this->merchant_salt, $this->merchant_key, true));
//
//    $post_vals=array(
//      'merchant_id'       => $this->merchant_id,
//      'name'              => $name,
//      'price'             => $price,
//      'currency'          => $this->currency,
//      'max_installment'   => $this->max_installment,
//      'link_type'         => $this->link_type,
//      'lang'              => $this->lang,
//      'min_count'         => "1",
//      'email'             => $email,
//      'expiry_date'       => Carbon::now()->addHour(5),
//      'max_count'         => "1",
//      'callback_link'     => "https://evot-tr.com/success",
//      'callback_id'       => "1",
//      'debug_on'          => 1,
//      'get_qr'            => 1,
//      'paytr_token'       => $paytr_token
//    );
//
//    $result = Http::post('https://www.paytr.com/odeme/api/link/create', $post_vals);
//
////    $ch=curl_init();
////    curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/link/create");
////    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
////    curl_setopt($ch, CURLOPT_POST, 1) ;
////    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
////    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
////    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
////    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
////    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
////    $result = @curl_exec($ch);
//
////    $result = json_decode($result,true);
//
//    dd($result);
//
////    dd($result);
//
//    return redirect($result['link']);
//
//  }

  public function index(Request $request) {
    $merchant_id    = '332444';
    $merchant_key   = '5B9J78CdGoFtpxJ6';
    $merchant_salt  = '9qHpXbz7gSRo8m6F';

    $name            = "Örnek Ürün / Hizmet Adı";
    $price           = 1445;
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
      $email         = time()."boss.Zelikov99@gmail.com";

      $required     .= 'boss.Zelikov99@gmail.com';
    }

    $expiry_date        = Carbon::now()->addHours(3);
    $max_count          = "1";
    $callback_link      = "https://evon-tr.com/api/payment/success";
    $callback_id        = "1";
    $debug_on           = 1;

    $paytr_token=base64_encode(hash_hmac('sha256', $required.$merchant_salt, $merchant_key, true));
    $post_vals=array(
      'merchant_id'       => $merchant_id,
      'name'              => $name,
      'price'             => $request->price,
      'currency'          => $currency,
      'max_installment'   => $max_installment,
      'link_type'         => $link_type,
      'lang'              => $lang,
      'min_count'         => $min_count,
      'email'             => 'boss.Zelikov99@gmail.com',
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

    if(curl_errno($ch))
      die("PAYTR LINK CREATE API request timeout. err:".curl_error($ch));

    curl_close($ch);

    $result=json_decode($result,1);

    return redirect($result['link']);
  }

}

