<?php

namespace App\Models\Builder\Flat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatImagesModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'flat_id',
      'name',
      'category',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
}
