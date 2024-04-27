<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Termwind\ValueObjects\p;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
      'session',
      'user_id',
      'active',
    ];

    protected $hidden = [
      'created_at',
      'updated_at'
    ];
}
