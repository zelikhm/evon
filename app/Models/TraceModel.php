<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraceModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'order_id',
      'price',
      'status',
      'user_id',
      'type'
    ];

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tarif() {
      return $this->belongsTo(TarifRussionModel::class, 'type', 'id');
    }
}
