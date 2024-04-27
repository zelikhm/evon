<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification_models';

    protected $fillable = [
      'user_id',
      'message',
      'active',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
}
