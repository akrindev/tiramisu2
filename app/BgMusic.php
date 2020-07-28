<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BgMusic extends Model
{

  	protected $table = 'bg_musics';

    public function comments()
    {
      return $this->hasMany(BgMusicComment::class);
    }
}