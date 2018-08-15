<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
    	'name'
    ];
  	public $timestamps = false;

  	public function monster()
    {
      return $this->hasMany(Monster::class);
    }
}