<?php

namespace App\Models\Builder\Info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'city_id'
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function city() {
      return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }
}
