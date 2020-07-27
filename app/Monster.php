<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Monster extends Model
{
  	use Searchable;

    protected $fillable = [
    	'map_id', 'element_id', 'name', 'level', 'type',
      	'hp', 'pet', 'picture', 'xp'
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

  /*
  // attributes
  */
  	public function getHpAttribute($value)
    {
      return is_null($value) ? null : number_format($value);
    }
}