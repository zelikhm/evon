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
    ];

    protected $hidden = [
      'chat_id',
    ];
}
