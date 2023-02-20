<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNewsModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
    ];
}
