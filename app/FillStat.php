<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FillStat extends Model
{
    protected $fillable = [
    	'type', 'plus',
      	'stats', 'steps'
    ];
}