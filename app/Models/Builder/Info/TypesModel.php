<?php

namespace App\Models\Builder\Info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
}
