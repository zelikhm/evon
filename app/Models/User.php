<?php

namespace App\Models;

use App\Models\User\Company;
use App\Models\User\Subscription;
use App\Models\User\Verification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Self_;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'email',
    'password',
    'ping',
    'role',
    'phone',
    'first_name',
    'last_name',
    'status',
    'link',
    'description',
    'image',
    'company_id',
    'checked',
    'token',
    'lang',
    'openClient',
    'deleted',
    'free_subscription'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function isAdmin() {
    if($this->role === 3 || $this->role === 2) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * has subscription
   * @return bool
   */

  public function hasSubscription() {
    $subscription = Subscription::where('user_id', $this->id)
      ->first();

    if($subscription) {
      if($subscription->finished_at > Carbon::now()) {
        return true;
      }
    }

    return false;
  } //end

  /**
   * get subscription
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function subscription() {
    return $this->belongsTo(Subscription::class, 'id', 'user_id');
  } //end

  /**
   * check verification
   * @return bool
   */

  public function isVerification()
  {
    $verification = Verification::where('user_id', $this->id)
      ->first();

    return $verification !== null ? $verification->isVerification === 2 : false;
  } //end

  /**
   * belong method for verification
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function verification()
  {
    return $this->belongsTo(Verification::class, 'id', 'user_id');
  } //end

  public function subscriptionInfo() {
    return $this->belongsTo(Subscription::class, 'id', 'user_id');
  }

  public function company() {
    return $this->belongsTo(Company::class, 'company_id', 'id');
  }
}
