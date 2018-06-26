<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
		'user_id', 'judul', 'body' ,
      	'slug', 'tags', 'views'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}