<?php


namespace App\Services\Mail;


interface RegisterMailInterface
{

  public function getMail($language_id);
  public function sendMailAdmin($message);
  public function sendMailUser($message);
  public function sendMail($email, $message);

}
