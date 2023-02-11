<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'chat_id',
    'message',
    'user_id'
  ];

  protected $hidden = [
    'chat_id',
  ];

  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d'
  ];
}
