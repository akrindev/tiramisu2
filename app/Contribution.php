<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
  protected $fillable = [
    'point'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}