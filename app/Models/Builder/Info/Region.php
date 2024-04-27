<?php

namespace App\Models\Builder\Info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'title_tr',
      'title_en',
      'city_id'
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function city() {
      return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
