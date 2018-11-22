<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmblemList extends Model
{
  protected $fillable = [
  	'name', 'body', 'reward'
  ];

  public $timestamps = false;

  public function emblem()
  {
    return $this->belongsTo(Emblem::class);
  }
}