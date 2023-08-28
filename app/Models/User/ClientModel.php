<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'name',
      'phone',
      'soc',
      'client_text',
      'status_client',
      'comment',
      'isJk',
      'manager_name',
      'manager_phone',
      'commission',
      'target_buy',
      'date_travel',
      'buy_form_id',
    ];

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public $timestamps = false;
}
