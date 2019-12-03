<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  protected $casts = [
  	'body' => 'json'
  ];

  public $fillable = [
  	'body'
  ];
}