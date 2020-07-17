<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    protected $guarded = [];

  	public function forum()
    {
      return $this->hasMany(Forum::class);
    }
}