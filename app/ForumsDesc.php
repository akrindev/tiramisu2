<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumsDesc extends Model
{
    protected $fillable = [
      'user_id', 'forum_id', 'body'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }
}