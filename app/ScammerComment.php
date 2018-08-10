<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScammerComment extends Model
{
  	protected $fillable = [
   		'user_id', 'parent_id', 'scammer_id', 'body'
    ];


    public function user()
    {
      return $this->belongsTo(User::class);
    }

  	public function scammer()
    {
      return $this->belongsTo(Scammer::class);
    }

  	public function getReply()
    {
      return $this->hasMany(ScammerComment::class,'parent_id');
    }

    public function notify($notify)
    {
      return $this->user->notify($notify);
    }
}