<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLog extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'image',
      'error',
    ];
}
