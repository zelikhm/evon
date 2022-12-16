<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseSupportModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'avatar',
    'name',
    'phone',
    'email',
    'status',
    'link',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function house() {
    return $this->belongsTo(HouseModel::class, 'house_id', 'id');
  }
}
