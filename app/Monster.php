<?php

namespace App;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
  	use Rememberable;

    protected $fillable = [
    	'map_id', 'element_id', 'name', 'level', 'type',
      	'hp', 'pet', 'picture'
    ];
  	public $timestamps = false;

  	public function drops()
    {
      return $this->belongsToMany(Drop::class, 'monster_drop');
    }

  	public function map()
    {
      return $this->belongsTo(Map::class);
    }

  	public function element()
    {
      return $this->belongsTo(Element::class);
    }
}