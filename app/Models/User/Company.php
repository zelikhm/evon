<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'image',
      'banner',
    ];

    public $timestamps = true;

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
}
