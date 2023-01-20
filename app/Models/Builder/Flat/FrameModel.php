<?php

namespace App\Models\Builder\Flat;

use App\Models\Builder\HouseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'name',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function house() {
    return $this->belongsTo(HouseModel::class, 'house_id', 'id');
  }

  public function flats() {
    return $this->hasMany(FlatModel::class, 'frame_id', 'id');
  }
}
