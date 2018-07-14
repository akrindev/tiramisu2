<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BgMusic extends Model
{
    public function comments()
    {
      return $this->hasMany(BgMusicComment::class);
    }
}