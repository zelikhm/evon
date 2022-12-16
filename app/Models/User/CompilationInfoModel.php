<?php

namespace App\Models\User;

use App\Models\Builder\HouseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompilationInfoModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'compilation_id',
      'house_id',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function compilation() {
      return $this->belongsTo(CompilationModel::class, 'compilation_id', 'id');
    }

    public function house() {
      return $this->belongsTo(HouseModel::class, 'house_id', 'id');
    }
}
