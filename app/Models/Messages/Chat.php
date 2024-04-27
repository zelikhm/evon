<?php

namespace App\Models\Messages;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
      'from_id',
      'to_id',
      'visible_id',
    ];

//    protected $hidden = [
//      'from_id',
//      'to_id',
//      'visible_id',
//      'created_at',
//      'updated_at',
//    ];

    protected $casts = [
      'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public $timestamps = true;

    public function from() {
      return $this->belongsTo(User::class, 'from_id', 'id');
    }

    public function to() {
      return $this->belongsTo(User::class, 'to_id', 'id');
    }

    public function messages() {
      return $this->hasMany(Message::class, 'chat_id', 'id');
    }
}
