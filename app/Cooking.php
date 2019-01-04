<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooking extends Model
{
  protected $fillable = [
  	'name', 'level', 'buff',
    'pt', 'picture'
  ];
}