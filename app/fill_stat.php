<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fill_stat extends Model
{
    protected $fillable = [
    	'type', 'plus',
      	'stats', 'steps'
    ];
}