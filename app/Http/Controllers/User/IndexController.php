<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseSupportModel;
use App\Models\User;
use App\Rules\Password;
use Illuminate\Http\Request;

class IndexController extends Controller
{

  use AuthCheck;

  /**
   * get user
   * @param Request $request
   * @return mixed
   */

  public function get(Request $request)
  {
    if ($this->checkToken($request->token)) {

      return response()->json(User::where('token', $request->token)
        ->with(['company', 'subscriptionInfo'])
        ->first(), 200);

    } else {

      return response()->json('not auth', 401);

    }
  }

  /**
   * set link
   * @param Request $request
   */

  public function setLink(Request $request) {

    if($this->checkToken($request->token)) {

      User\SubscriptionModel::where('id', $request->id)->update(['free_link' => 0]);

      return response()->json(true, 200);
    } else {

      return response()->json('not auth', 401);
    }

  }

  /**
   * save lang
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function lang(Request $request) {

    if ($this->checkToken($request->token)) {

      User::where('id', $request->id)->update(['lang' => $request->lang]);

      return response()->json($request->lang, 200);
    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * edit user
   * @param Request $request
   */

  public function edit(Request $request)
  {
    if ($this->checkToken($request->token)) {

      if($request->image !== 'undefined') {
        $imageName = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('/storage/user'), $imageName);
        $imageName = '/storage/user/' . $imageName;
      } else {
       $user = User::where('id', $request->user_id)->first();
       $imageName = $user->image;
      }

      User::where('id', $request->user_id)->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'status' => $request->status,
        'link' => $request->link,
        'phone' => $request->phone,
        'description' => $request->description,
        'email' => $request->email,
        'image' => $imageName,
      ]);

      return response()->json(User::where('id', $request->user_id)->with(['company'])->first(), 200);

    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * send register
   * @param Request $request
   */

  public function sendRegister(Request $request) {

    $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'language_id' => 'required'
    ]);

    $curl = curl_init();

    $this->sendUserEmail($request->email, $request->language_id);

    $message = "<html><head></head><body><p>
                Подана заявка на регистрацию<br>
                Имя: . $request->first_name<br>
                Фамилия: . $request->last_name<br>
                Телефон: . $request->phone<br>
                Email: . $request->email<br>
                Место работы: . $request->type<br>
                </p></body></html>";

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.smtp.bz/v1/smtp/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
        "authorization: AwFGFIPriK4AQad1rFXt9ox1c00PT8LjugQ1"
      ),
      CURLOPT_POSTFIELDS => http_build_query(array(
        'subject' => "Регистрация нового пользователя", // Обязательно
        'name' => "Evon",
        'html' => $message, // Обязательно
        'from' => "info@evon-tr.com", // Обязательно
        'to' => "evon.information@gmail.com", // Обязательно
        'headers' => "[{ 'x-tag': 'my_newsletter_ids' }]",
        'text' => "Text version message"
      ))
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


  }

  /**
   * send email user
   * @param $email
   * @param $language
   */

  public function sendUserEmail($email, $language) {
    $curl = curl_init();

    if($language == 0) {
      $message = "<html><head></head><body><p>
                <i>Это информационное письмо, не отвечайте на него.</i><br>
                <br>
                Здравствуйте,<br>
                Мы получили заявку на регистрацию на сайте <b>evon-tr.com</b> от вашего имени.
                <br>Обращаем ваше внимание, что информация на сайте предназначена только для агентов по недвижимости и строительных компаний.
                <br>
                <br>Для получения доступа необходимо пройти процедуру подтверждения вашей деятельности, предоставив один из следующих вариантов на почту <b>evon.information@gmail.com</b>:
                <br>
                - Ссылку на ваши профили в социальных сетях/на сайтах с указанием вашей деятельности.<br>
                - Контакты двух риелторов и или контакт руководителя, которые могут подтвердить вашу деятельность.<br>
                - Лицензию на работу в данной сфере.<br>
                <br>
                Пожалуйста, отправьте нам выбранный вариант информации на почту <b>evon.information@gmail.com</b>.<br>
                После проверки мы предоставим вам доступ к нашей платформе и информируем вас по электронной почте.<br>
                Мы благодарим вас за проявленный интерес и надеемся на долгосрочное сотрудничество.
                </p></body></html>";
    } else if ($language == 1) {
      $message = "<html><head></head><body><p>
                  <i>This is an informational letter, do not reply to it.</i><br>
                  <br>
                  Hello,<br>
                  We have received an application to register on <b>evon-tr.com</b> on your behalf.
                  <br>Please note that the information on the site is intended only for real estate agents and construction companies.
                  <br>
                  <br>To gain access, you must go through the procedure for confirming your activity by providing one of the following options to <b>evon.information@gmail.com</b>:
                  <br>
                  - A link to your social media profiles/websites indicating your activities.<br>
                  - Contacts of two realtors and or contact of the head who can confirm your activities.<br>
                  - License to work in this field.<br>
                  <br>
                  Please send us your chosen information option to <b>evon.information@gmail.com</b>.<br>
                  After verification, we will grant you access to our platform and inform you by email.<br>
                  We thank you for your interest and look forward to long-term cooperation.
                </p></body></html>";
    } else if ($language == 2) {
      $message = "<html><head></head><body><p>
                  <i>Bu bir bilgilendirme mesajıdır, cevap vermeyiniz.</i><br>
                   <br>
                  Merhaba,<br>
                  Adınıza <b>evon-tr.com</b>'a kayıt başvurusu tarafımıza ulaşmıştır.
                  <br>Web sitesindeki verilerin sadece emlakçılar ve inşaat şirketleri için olduğunu lütfen unutmayın.
                  <br>Erişim sağlamak için, aşağıdakilerden birini evon.information@gmail.com adresine göndererek işinizi onaylama prosedüründen geçmelisiniz:
                  <br>
                  - Faaliyetlerinizi gösteren sosyal medya/web sitesi profillerinize bir bağlantı gönderiniz.<br>
                  - Faaliyetlerinizi teyit edebilecek iki Emlak Danışmanının ve / veya yöneticinizin iletişim bilgilerini paylaşınız.<br>
                  - Sahada faaliyet gösterebilmek için bir lisans gönderiniz.<br>
                  <br>
                  Lütfen bilgilerinizi <b>evon.information@gmail.com</b> adresine gönderin.<br>
                  Doğrulama aşamasından sonra platformumuza erişiminizi sağlayacağız ve e-posta ile sizi bilgilendireceğiz.<br>
                  İlginiz için teşekkür ediyor ve uzun vadeli bir işbirliği yürütmeyi umuyoruz.
                </p></body></html>";
    }

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.smtp.bz/v1/smtp/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
        "authorization: AwFGFIPriK4AQad1rFXt9ox1c00PT8LjugQ1"
      ),
      CURLOPT_POSTFIELDS => http_build_query(array(
        'subject' => "Регистрация нового пользователя", // Обязательно
        'name' => "Evon",
        'html' => $message, // Обязательно
        'from' => "info@evon-tr.com", // Обязательно
        'to' => $email, // Обязательно
        'headers' => "[{ 'x-tag': 'my_newsletter_ids' }]",
        'text' => "Text version message"
      ))
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

  }
}
