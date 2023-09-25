<?php


namespace App\Services\Mail;


class RegisterMailService implements RegisterMailInterface
{

  /**
   * get mail
   * @param $form
   */

  public function getMail($form)
  {

    $this->SendMailAdmin($form);
    $this->sendMailUser($form);

  } //end

  /**
   * send email for admin
   * @param $form
   */

  public function SendMailAdmin($form)
  {

    $message = "<html><head></head><body><p>
                Подана заявка на регистрацию<br>
                Имя: . $form->first_name<br>
                Фамилия: . $form->last_name<br>
                Телефон: . $form->phone<br>
                Email: . $form->email<br>
                Место работы: . $form->type<br>

                </p></body></html>";

    return $this->sendMail("evon.information@gmail.com", $message);
  } //end

  /**
   * send email for user
   * @param $language_id
   * @param $form
   * @return bool
   */

  public function sendMailUser($form)
  {

    if($form->language_id == 0) {
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
    } else if ($form->language_id == 1) {
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
    } else if ($form->language_id == 2) {
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

    return $this->sendMail($form->email, $message);
  }

  /**
   * send email
   * @param $email
   * @param $message
   * @return bool
   */

  public function sendMail($email, $message) {
    $curl = curl_init();

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

    try {
      return true;
    } catch (\Exception $exception) {

      info($exception);

      return false;
    }
  } //end
}
