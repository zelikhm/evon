<?php

namespace App\Models\Builder\Flat;

use App\Models\Builder\House;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
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
      'imageUp',
      'imageDown',
      'isResizeImageUp',
      'isResizeImageDown'
    ];

    protected $casts = [
      'created_at' => 'datetime:Y-m-d H:i:s'
    ];

//    protected $hidden = [
//      'created_at',
//      'updated_at',
//    ];

    public function house() {
      return $this->hasOneThrough(House::class, Frame::class, 'id', 'id', 'frame_id', 'house_id');
    }

    public function frame() {
      return $this->belongsTo(Frame::class, 'frame_id', 'id');
    }

    public function images() {
      return $this->hasMany(FlatImagesModel::class, 'flat_id', 'id');
    }
}
