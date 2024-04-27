<?php

namespace App\Models\Builder\Info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'title_tr',
    'title_en',
    'longitude',
    'latitude',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function regions() {
    return $this->hasMany(Region::class, 'city_id', 'id');
  }
}
