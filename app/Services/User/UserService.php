<?php


namespace App\Services\User;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

Abstract class UserService implements UserInterface
{

  /**
   * get user
   * @param $user_id
   * @return array|null
   */

  public function getUser($user_id)
  {

    $user = User::where('id', $user_id)
      ->with(['company', 'subscriptionInfo'])
      ->first();

    if ($user !== null) {
      $user->subscription = $user->subscription();
    } else {
      $user = [];
    }

    return $user;
  } //end

  /**
   * check has user in the base
   * @param null $email
   * @param null $id
   * @param null $phone
   * @return |null
   */

  public function checkUser($email = null, $id = null, $phone = null) {

    if($email) {
      $user = User::where('email', 'LIKE', '%' . $email . '%')->first();
    } else if ($id) {
      $user = User::where('id', $id)->first();
    } else if ($phone) {
      $user = User::where('phone', 'LIKE', '%' . $phone . '%')->first();
    } else {
      $user = null;
    }

    return $user;
  } //end

  /**
   * check token for user
   * @param $user_id
   * @param $token
   * @return bool
   */

  public function checkToken($user_id, $token) {

    $user = Auth::user();

    return $user->id === $user_id && $token === $user->token ? true : false;

  } //end

  /**
   * register user
   * @param $form
   * @return mixed
   */

  public function register($form) {

    return User::create([
      'email' => $form['email'],
      'password' => $form['password'],
      'role' => $form['type_id'] < 3 ? 0 : 1,
      'phone' => $form['phone'],
      'first_name' => $form['first_name'],
      'last_name' => $form['last_name'],
    ]);

  } //end
}
