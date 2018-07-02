<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fill_stat extends Model
{
    protected $fillable = [
    	'type', 'plus',
      	'stats', 'steps'
    ];
}