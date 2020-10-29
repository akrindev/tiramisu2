<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App;
use App\Traits\Searchable;

class Drop extends Model
{
  	use Searchable;

  	protected $casts = [
    	'note'	=> 'json'
    ];

    protected $guarded = [];

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
      return $this->hasOne(DropDone::class, 'drop_id');
    }

  	public function getNameAttribute()
    {
        if(App::isLocale('en')) {
            return $this->attributes['name_en'];
        }

        return $this->attributes['name'];
    }

}