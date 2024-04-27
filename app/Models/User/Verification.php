<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'link',
      'file',
      'isVerification',
      'text'
    ];

  /**
   * belong method for user
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    } //end
}
