<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseNew extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'title',
    'description',
    'visible',
  ];

  protected $casts = [
    'updated_at' => 'datetime: d-m-Y'
  ];

  protected $hidden = [
//    'created_at',
//    'updated_at',
  ];

  public function house() {
    return $this->belongsTo(House::class, 'house_id', 'id');
  }
}
