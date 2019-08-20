<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Map extends Model
{
    use Searchable;

    protected $fillable = [
    	'name'
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
}