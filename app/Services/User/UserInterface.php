<?php


namespace App\Services\User;


interface UserInterface
{

  public function getUser($user_id);
  public function checkToken($user_id, $token);
  public function checkUser($email = null, $id = null, $phone = null);
  public function register($form);

}
