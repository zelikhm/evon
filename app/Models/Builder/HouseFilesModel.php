<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseFilesModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'house_id',
    'name',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
