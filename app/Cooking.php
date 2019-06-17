<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooking extends Model
{
  protected $fillable = [
  	'name', 'buff', 'stat', 'pt'
  ];

  public $timestamps = false;

  public function user()
  {
    return $this->hasOne(User::class);
  }
}