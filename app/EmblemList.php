<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmblemList extends Model
{
  protected $fillable = [
  	'name', 'body', 'reward', 'update'
  ];

  public function emblem()
  {
    return $this->belongsTo(Emblem::class);
  }
}