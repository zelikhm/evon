<?php

namespace App\Models\User;

use App\Models\Builder\House;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'house_id',
      'created_at',
      'updated_at',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function house() {
      return $this->belongsTo(House::class, 'house_id', 'id');
    }
}
