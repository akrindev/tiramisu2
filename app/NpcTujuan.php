<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpcTujuan extends Model
{
  protected $table = 'npc_tujuan';
  public $timestamps = false;
  public $fillable = [
  	'defeat', 'drop_id', 'monster_id', 'many'
  ];

  public function quest()
  {
    return $this->belongsTo(NpcQuest::class);
  }

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }

  public function monster()
  {
    return $this->belongsTo(Monster::class);
  }
}