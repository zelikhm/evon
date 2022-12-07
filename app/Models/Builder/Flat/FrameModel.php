<?php

namespace App\Models\Builder\Flat;

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

  public function flats() {
    return $this->hasMany(FlatModel::class, 'id', 'frame_id');
  }
}
