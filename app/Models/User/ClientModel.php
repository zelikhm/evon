<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'name',
      'phone',
      'soc',
      'client_text',
      'jk',
      'status_client',
      'status_order',
      'comment'
    ];
}
