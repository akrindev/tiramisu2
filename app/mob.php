<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mob extends Model
{
    protected $fillable = [
    	'nama', 'slug', 'type', 'element',
      	'hp', 'xp', 'level', 'map',
      	'mapslug', 'kandang', 'pics',
      	'drop_items', 'drop_equip', 'notes'
    ];
}