<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

use App;

class Map extends Model
{
    use Searchable;

    protected $fillable = [
    	'name', 'name_en'
    ];

  	public $timestamps = false;

  	public function monster()
    {
      return $this->hasMany(Monster::class);
    }

  	public function npc()
    {
      return $this->hasMany(Npc::class);
    }


    public function getNameAttribute()
    {
        if(App::isLocale('en')) {
            return $this->attributes['name_en'];
        }

        return $this->attributes['name'];
    }
}