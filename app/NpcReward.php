<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpcReward extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'drop_id', 'many'
  ];

  public function quest()
  {
    return $this->belongsTo(NpcQuest::class);
  }

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }
}