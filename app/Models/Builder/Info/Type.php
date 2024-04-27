<?php

namespace App\Models\Builder\Info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'name_tr',
      'name_en'
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
}
