<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScammerComment extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class);
    }

  	public function scammer()
    {
      return $this->belongsTo(Scammer::class);
    }
}