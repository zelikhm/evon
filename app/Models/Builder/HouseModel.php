<?php

namespace App\Models\Builder;

use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\Info\CityModel;
use App\Models\Builder\Info\RegionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'title',
    'description',
    'description_tr',
    'description_en',
    'city',
    'area',
    'longitude',
    'latitude',
    'percent',
    'comment',
    'active',
    'slug',
    'fool_price',
    'visible',
    'created'
  ];
//
//  protected $hidden = [
//    'created_at',
//    'updated_at',
//  ];

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function files() {
    return $this->hasMany(HouseFilesModel::class, 'house_id', 'id');
  }

  public function images() {
    return $this->hasMany(HouseImagesModel::class, 'house_id', 'id');
  }

  public function info() {
    return $this->belongsTo(HouseCharacteristicsModel::class, 'id', 'house_id');
  }

  public function supports() {
    return $this->hasMany(HouseSupportModel::class, 'house_id', 'id');
  }

  public function frames() {
    return $this->hasMany(FrameModel::class, 'house_id', 'id');
  }

  public function news() {
    return $this->hasMany(HouseNewsModel::class, 'house_id', 'id');
  }

  public function city_object() {
    return $this->belongsTo(CityModel::class, 'city', 'title');
  }

  public function flats() {
    return $this->hasManyThrough(
      FlatModel::class,
      FrameModel::class,
      'house_id',
      'frame_id',
      'id',
      'id'
    );
  }
}
