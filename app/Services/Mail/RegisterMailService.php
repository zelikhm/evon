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

  public function sendMailAdmin($form)
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

    if ($form->language_id == 0) {
      $message = "<html><head></head><body>
                  Здравствуйте,<br>
                  Мы получили заявку на регистрацию на сайте evon-tr.com от вашего имени.<br>
                  <br>
                  <br>Вам был создан личный кабинет.
                  <br>Вы можете зайти на сайт Evon-tr.com
                  <br>по своей почте нажав «Войти». Одноразовый пароль придет на вашу почту.
                  <br>
                  <br>В профиле вы можете пройти верификацию для получения доступа к самой большой базе недвижимости и функциям платформы EVON.
                  <br>
                  <br>Добро пожаловать на платформу недвижимости EVON.
                  <br>
                  <br>WhatsApp +90 544 225 85 59
                  <br>evon.information@gmail.com
                  </body></html>";
    } else if ($form->language_id == 1) {
      $message = "<html><head></head><body>
                  Hello, <br>
                  We have received an application for registration on the website evon-tr.com on your behalf.<br>
                  <br>
                  <br>A personal account has been created for you. You can go to Evon-tr.com
                  <br>Via your email by clicking “Login”.
                  <br>A one-time password will be sent to your email.
                  <br>
                  <br>In your profile, you can pass verification to gain access to the largest real estate database and functions of the EVON platform.
                  <br>
                  <br>Welcome to the EVON real estate platform.
                  <br>
                  <br>WhatsApp +90 544 225 85 59
                  <br>evon.information@gmail.com
                  </body></html>";
    } else if ($form->language_id == 2) {
      $message = "<html><head></head><body>
                  Merhaba,<br>
                  evon-tr.com internet sitesinden sizin adınıza kayıt başvurusu aldık.<br>
                  <br>
                  <br>Sizin için kişisel bir hesap oluşturuldu. Evon-tr.com'a gidebilirsiniz.
                  <br>“Giriş” düğmesine tıklayarak e-postanız aracılığıyla.
                  <br>E-posta adresinize tek kullanımlık şifre gönderilecektir.
                  <br>
                  <br>Profilinizde, EVON platformunun en büyük emlak veritabanına ve işlevlerine erişim sağlamak için doğrulamayı geçebilirsiniz.
                  <br>
                  <br>EVON emlak platformuna hoş geldiniz.
                  <br>
                  <br>WhatsApp +90 544 225 85 59
                  <br>evon.information@gmail.com
                  </body></html>";
    }

    return $this->sendMail($form->email, $message);
  }

  /**
   * send email
   * @param $email
   * @param $message
   * @return bool
   */

  public function sendMail($email, $message)
  {
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
