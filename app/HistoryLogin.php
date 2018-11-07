<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLogin extends Model
{
  protected $fillable = [
  	'ip', 'browser', 'extra'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}