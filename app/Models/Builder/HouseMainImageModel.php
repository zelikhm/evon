<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseMainImageModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'image',
    'isResize'
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  /**
   * belong method for house
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function house() {
    return $this->belongsTo(HouseModel::class, 'house_id', 'id');
  } //end
}
