<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

use App;

class Monster extends Model
{
  	use Searchable;

    protected $guarded = [];

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

    public function getNameAttribute()
    {
        if(App::isLocale('en')) {
            return $this->attributes['name_en'];
        }

        return $this->attributes['name'];
    }
}