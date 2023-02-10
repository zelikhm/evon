<?php

namespace App\Http\Traits;

use App\Models\User;

trait AuthCheck {

  /**
   * check token for user
   * @param $token
   * @return bool
   */

  private function checkToken($token) {

    $user = User::where('token', $token)->first();

    if($user !== null) {
      return true;
    } else {
      return false;
    }

  }


}
