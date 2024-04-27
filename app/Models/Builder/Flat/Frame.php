<?php

namespace App\Models\Builder\Flat;

use App\Models\Builder\House;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'name',
  ];

//  protected $hidden = [
//    'created_at',
//    'updated_at',
//  ];

  public function house() {
    return $this->belongsTo(House::class, 'house_id', 'id');
  }

  public function flats() {
    return $this->hasMany(Flat::class, 'frame_id', 'id');
  }
}
