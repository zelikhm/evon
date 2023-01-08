<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
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
