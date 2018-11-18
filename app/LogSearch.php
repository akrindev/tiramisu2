<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogSearch extends Model
{
  protected $fillable = [
  	'user_id', 'q'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}