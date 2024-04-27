<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtmStat extends Model
{
    use HasFactory;

    protected $fillable = [
      'ip',
      'utm_id',
      'is_reg'
    ];

    public function utm()
    {
      return $this->belongsTo(Utm::class, 'utm_id', 'id');
    }
}
