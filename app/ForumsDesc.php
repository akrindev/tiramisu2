<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumsDesc extends Model
{
    protected $fillable = [
      'user_id', 'forum_id', 'body', 'parent_id'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }


  	public function getReply()
    {
      return $this->hasMany(ForumsDesc::class,'parent_id');
    }
}