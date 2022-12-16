<?php

namespace App\Models\Builder\Info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function regions() {
    return $this->hasMany(RegionModel::class, 'city_id', 'id');
  }
}
