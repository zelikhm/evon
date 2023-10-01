<?php


namespace App\Services\User;


interface RegisterInterface
{

  public function startRegister($form);
  public function registerRielter($form);
  public function registerBuilder($form);

}
