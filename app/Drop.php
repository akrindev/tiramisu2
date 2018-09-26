<?php

namespace App;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
  	use Rememberable;

    protected $fillable = [
    	'name', 'sell', 'proses', 'note', 'picture'
    ];
  	public $timestamps = false;

  	public function dropType()
    {
      return $this->belongsTo(DropType::class);
    }

  	public function monsters()
    {
      return $this->belongsToMany(Monster::class, 'monster_drop');
    }

  	public function resep()
    {
      return $this->hasMany(Resep::class);
    }

  	public function fromQuest()
    {
      return $this->hasMany(NpcReward::class);
    }

  	public function dropDone()
    {
      return $this->hasOne(DropDone::class);
    }
}