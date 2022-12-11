<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompilationModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'title',
      'description',
      'isVisible',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function values() {
      return $this->hasMany(CompilationInfoModel::class, 'id', 'compilation_id');
    }

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
