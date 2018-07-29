<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ForumsDesc extends Model
{
  use Notifiable;

    protected $fillable = [
      'user_id', 'forum_id', 'body', 'parent_id'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }

  	public function forum()
    {
      return $this->belongsTo(Forum::class);
    }

  	public function getReply()
    {
      return $this->hasMany(ForumsDesc::class,'parent_id');
    }


  public function notify($notify)
  {
    return $this->user->notify($notify);
  }

  public function likes()
  {
    return $this->morphMany(Like::class, 'likeable');
  }
}