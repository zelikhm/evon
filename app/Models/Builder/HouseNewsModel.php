<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseNewsModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'title',
    'description',
    'visible',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function house() {
    return $this->belongsTo(HouseModel::class, 'house_id', 'id');
  }
}
