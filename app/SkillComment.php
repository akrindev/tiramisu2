<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillComment extends Model
{
  public $fillable = [
  	'user_id', 'skill_list_id', 'body'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function notify($notify)
  {
    return $this->user->notify($notify);
  }
}