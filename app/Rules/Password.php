<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Password implements Rule, DataAwareRule
{

  /**
   * All of the data under validation.
   *
   * @var array
   */
  protected $data = [];


  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Set the data under validation.
   *
   * @param array $data
   * @return $this
   */

  public function setData($data)
  {
    $this->data = $data;

    return $this;
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param string $attribute
   * @param mixed $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    $user = User::where('email', $this->data['email'])->first();

    if($user === null) {
      return false;
    } else {
      if(!Hash::check($value, $user->password)) {
        return false;
      } else {
        return true;
      }
    }


  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'Пароль не верный';
  }
}
