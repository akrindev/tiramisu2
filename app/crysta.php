<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crysta extends Model
{
    protected $fillable = [
    	'nama', 'slug', 'stats',
      	'type', 'typeslug'
    ];
}