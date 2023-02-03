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

  public function index(Request $request) {

    $name = "Nikita Zelikov";

    $email = 'boss.Zelikov99@gmail.com';

    $price = 1445;

    $required = $name.$price.$this->currency.$this->max_installment.$this->link_type.$this->lang.$this->min_count;

    $paytr_token=base64_encode(hash_hmac('sha256', $required.$this->merchant_salt, $this->merchant_key, true));

    $post_vals=array(
      'merchant_id'       => $this->merchant_id,
      'name'              => $name,
      'price'             => $price,
      'currency'          => $this->currency,
      'max_installment'   => $this->max_installment,
      'link_type'         => $this->link_type,
      'lang'              => $this->lang,
      'min_count'         => "1",
      'email'             => $email,
      'expiry_date'       => Carbon::now()->addHour(5),
      'max_count'         => "1",
      'callback_link'     => "https://evot-tr.com/success",
      'callback_id'       => "1",
      'debug_on'          => 1,
      'get_qr'            => 1,
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

    $result=json_decode($result,1);

//    dd($result);

    return redirect($result['link']);

  }

}

