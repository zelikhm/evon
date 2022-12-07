<?php

namespace App\Models\Builder;

use App\Models\Builder\Flat\FrameModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'title',
    'description',
    'city',
    'area',
    'longitude',
    'latitude',
    'percent',
    'comment',
    'active',
    'status',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function files() {
    return $this->hasMany(HouseFilesModel::class, 'id', 'house_id');
  }

  public function info() {
    return $this->belongsTo(HouseCharacteristicsModel::class, 'id', 'house_id');
  }

  public function supports() {
    return $this->hasMany(HouseSupportModel::class, 'id', 'house_id');
  }

  public function frames() {
    return $this->hasMany(FrameModel::class, 'id', 'house_id');
  }
}
