<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'name', 'map_id', 'picture'
  ];

  public function quest()
  {
    return $this->hasMany(NpcQuest::class);
  }

  public function map()
  {
    return $this->belongsTo(Map::class);
  }
}