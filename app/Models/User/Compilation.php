<?php

namespace App\Models\User;

use App\Models\Builder\House;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compilation extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'title',
      'description',
      'isVisible',
    ];

//    protected $hidden = [
//      'created_at',
//      'updated_at',
//    ];

    public function values() {
      return $this->hasMany(CompilationInfo::class, 'compilation_id', 'id');
    }

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function company() {
//      return $this->hasOneThrough(
//        Company::class,
//        User::class,
//        'id',
//        'company_id',
//        'user_id',
//        'id'
//      );
//    }

    public function houses() {
      return $this->hasManyThrough(
        House::class,
        CompilationInfo::class,
        'compilation_id',
        'id',
        'id',
        'house_id'
      );
    }

    public function company() {
      return $this->hasOneThrough(
        Company::class,
        User::class,
        'id',
        'id',
        'user_id',
        'company_id'
      );
    }
}
