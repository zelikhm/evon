<?php

namespace App\Models\User;

use App\Models\Builder\HouseModel;
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
      return $this->hasMany(CompilationInfoModel::class, 'compilation_id', 'id');
    }

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function company() {
//      return $this->hasOneThrough(
//        CompanyModel::class,
//        User::class,
//        'id',
//        'company_id',
//        'user_id',
//        'id'
//      );
//    }

    public function houses() {
      return $this->hasManyThrough(
        HouseModel::class,
        CompilationInfoModel::class,
        'compilation_id',
        'id',
        'id',
        'house_id'
      );
    }

    public function company() {
      return $this->hasOneThrough(
        CompanyModel::class,
        User::class,
        'id',
        'id',
        'user_id',
        'company_id'
      );
    }
}
