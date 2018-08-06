<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatScammer extends Model
{
    public function scammer()
    {
      return $this->hasMany(Scammer::class);
    }
}