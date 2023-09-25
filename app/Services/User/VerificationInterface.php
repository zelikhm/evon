<?php


namespace App\Services\User;


use App\Services\Mail\RegisterMailService;

interface VerificationInterface
{

  public function sendVerification($form, $user_id, RegisterMailService $registerMailService);
  public function editStatus($verification_id, $status);

}
