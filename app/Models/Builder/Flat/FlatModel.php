<?php

namespace App\Models\Builder\Flat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'frame_id',
      'number',
      'square',
      'count',
      'floor',
      'status',
      'number_from_stairs',
      'price',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function images() {
      return $this->hasMany(FlatImagesModel::class, 'id', 'flat_id');
    }
}
