<?php

namespace App\Models\Builder;

use App\Models\Builder\Info\TypesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseCharacteristicsModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'floors',
    'type',
    'dop',
    'info',
    'toSea',
    'toSchool',
    'toShop',
    'toPark',
    'toBus',
    'toChildrenSchool',
    'count_flat',
    'exclusive',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function house() {
    return $this->belongsTo(HouseModel::class, 'house_id', 'id');
  }
}
