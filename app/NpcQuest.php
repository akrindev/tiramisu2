<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpcQuest extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'name', 'npc_id', 'level', 'exp', 'detail'
  ];

  public function npc()
  {
    return $this->belongsTo(Npc::class);
  }

  public function tujuan()
  {
    return $this->hasMany(NpcTujuan::class);
  }

  public function reward()
  {
    return $this->hasMany(NpcReward::class);
  }
}