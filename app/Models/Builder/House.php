<?php

namespace App\Models\Builder;

use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\Info\City;
use App\Models\Builder\Info\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
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

  /**
   * belong method for main image for house
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function mainImage() {
    return $this->belongsTo(HouseMainImage::class, 'house_id', 'id');
  } //end

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function files() {
    return $this->hasMany(HouseFile::class, 'house_id', 'id');
  }

  public function images() {
    return $this->hasMany(HouseImage::class, 'house_id', 'id');
  }

  public function info() {
    return $this->belongsTo(HouseCharacteristic::class, 'id', 'house_id');
  }

  public function supports() {
    return $this->hasMany(HouseSupport::class, 'house_id', 'id');
  }

  public function frames() {
    return $this->hasMany(Frame::class, 'house_id', 'id');
  }

  public function news() {
    return $this->hasMany(HouseNew::class, 'house_id', 'id');
  }

  public function city_object() {
    return $this->belongsTo(City::class, 'city', 'title');
  }

  public function flats() {
    return $this->hasManyThrough(
      Flat::class,
      Frame::class,
      'house_id',
      'frame_id',
      'id',
      'id'
    );
  }
}
