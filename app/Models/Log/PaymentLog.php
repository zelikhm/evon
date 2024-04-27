<?php

namespace App\Models\Log;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'text',
    ];

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
