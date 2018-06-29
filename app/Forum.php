<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
  use SoftDeletes;

    protected $fillable = [
		'user_id', 'judul', 'body' , 'pinned',
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

	public function scopeNotReply($query)
    {
      return $this->whereNull('parent_id');
    }
}