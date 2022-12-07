<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseViewsModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'house_id',
      'view',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
}
