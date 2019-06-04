<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMail extends Model
{
    protected $fillable = [
    	'subject', 'user_id', 'body', 'sender'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }

  	public function getBodyAttribute($value)
    {
      return parsedown($value);
    }
}