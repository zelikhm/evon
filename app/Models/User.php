<?php

namespace App\Models;

use App\Models\User\CompanyModel;
use App\Models\User\SubscriptionModel;
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

  public function subscription() {

    $sub = SubscriptionModel::where('user_id', $this->id)->first();

    if($sub !== null) {
      if($sub->finished_at > Carbon::now()->addHour(3)) {
        if($sub->active === 1) {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }

  }

  public function subscriptionInfo() {
    return $this->belongsTo(SubscriptionModel::class, 'id', 'user_id');
  }

  public function company() {
    return $this->belongsTo(CompanyModel::class, 'company_id', 'id');
  }
}
