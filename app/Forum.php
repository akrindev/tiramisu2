<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Traits\Searchable;

class Forum extends Model
{
  use SoftDeletes, Notifiable, Searchable;

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

  public function notify($notify)
  {
    return $this->user->notify($notify);
  }

  public function likes()
  {
    return $this->morphMany(Like::class, 'likeable');
  }

  public function myLike(\App\Like $like)
  {
    return $like->where('user_id',$this->id);
  }


}