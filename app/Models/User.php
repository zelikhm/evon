<?php

namespace App\Models;

use App\Models\User\CompanyModel;
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
    if($this->role === 3) {
      return true;
    } else {
      return false;
    }
  }

  public function company() {
    return $this->belongsTo(CompanyModel::class, 'id', 'user_id');
  }
}
