<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Gallery extends Model
{
    use SoftDeletes, Notifiable;

  	protected $fillable = [
    	'user_id', 'body', 'gambar'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }

  	public function comments()
    {
      return $this->hasMany(GalleryComment::class);
    }

  	public function notify($notify)
    {
      return $this->user->notify($notify);
    }
}