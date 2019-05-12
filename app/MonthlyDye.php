<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyDye extends Model
{
    protected $guarded = [];

  	public function monster()
    {
      return $this->belongsTo(Monster::class);
    }

  	public function dye()
    {
      return $this->belongsTo(Dye::class);
    }
}