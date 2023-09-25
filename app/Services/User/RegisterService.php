<?php


namespace App\Services\User;


use function Symfony\Component\String\splice;

class RegisterService extends UserService implements RegisterInterface
{

  /**
   * generation password
   * @return string
   */

  private function generationPass()
  {

    return substr(hash("sha256", rand(12, 12)), 0, 12);

  } //end

  /**
   * start registration
   * @param $form
   * @return bool|mixed
   */

  public function startRegister($form)
  {

    if ($form['type_id'] < 3) {
      return ['status' => $this->registerRielter($form), 'builder' => false];
    } else {
      return ['status' => $this->registerBuilder($form), 'builder' => true];
    }

  } //end

  /**
   * register rielter
   * @param $form
   * @return bool|mixed
   */

  public function registerRielter($form)
  {

    if ($this->checkUser($form['email'], null, $form['phone'])) {
      return false;
    }

    $form['password'] = $this->generationPass();

    return $this->register($form);

  } //end

  /**
   * register builder
   * @param $form
   * @return bool|mixed
   */

  public function registerBuilder($form)
  {

    if ($this->checkUser($form['email'], null, $form['phone'])) {
      return false;
    }

//    $form['password'] = $this->generationPass();
//
//    return $this->register($form);

    return true;

  } //end
}
