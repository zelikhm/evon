<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNew extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
    ];
}
