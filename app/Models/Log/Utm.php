<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utm extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'utm_code',
    ];

    public function users()
    {
      return $this->hasMany(UtmStat::class, 'utm_id', 'id');
    }
}
