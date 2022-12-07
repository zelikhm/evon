<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseCharacteristicsModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'status',
    'floors',
    'type',
    'dop',
    'info',
    'toSea',
    'toSchool',
    'toShop',
    'toPark',
    'toChildrenSchool',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
