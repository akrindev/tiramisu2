<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fcm extends Model
{
    protected $table = 'fcm_tokens';

  	protected $fillable = [
    	'user_id', 'token'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}