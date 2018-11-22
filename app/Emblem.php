<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emblem extends Model
{
  protected $fillable = [
  	'name'
  ];

  public $timestamps = false;

  public function child()
  {
    return $this->hasMany(EmblemList::class, 'emblem_id');
  }
}