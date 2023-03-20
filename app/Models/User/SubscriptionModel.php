<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'active',
      'finished_at',
    ];

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company() {
      return $this->hasOneThrough(
        CompanyModel::class,
        User::class,
        'id',
        'id',
        'user_id',
        'company_id'
      );
    }
}
