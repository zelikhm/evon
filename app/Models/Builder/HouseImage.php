<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    use HasFactory;

    protected $fillable = [
      'house_id',
      'category',
      'name',
      'isResize'
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function house() {
      return $this->belongsTo(House::class, 'house_id', 'id');
    }
}
