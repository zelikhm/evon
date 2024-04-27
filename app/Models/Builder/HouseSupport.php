<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseSupport extends Model
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
    return $this->belongsTo(House::class, 'house_id', 'id');
  }
}
