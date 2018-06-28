<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
		'user_id', 'judul', 'body' ,
      	'slug', 'tags', 'views', 'color'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function comment()
  {
    return $this->hasMany(ForumsDesc::class);
  }
}