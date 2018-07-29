<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Forum;
use App\ForumsDesc;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'provider_id', 'username', 'link','biodata','ign'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

  	public function isAdmin()
    {
      return $this->role == 'admin' ? true : false;
    }

  	/**
    *
    * User likes
    */
  	public function likes()
    {
      return $this->morphMany(Like::class, 'likeable');
    }

  	public function hasLikedThread(Forum $forum)
    {
      return (bool) $forum->likes
        ->where('likeable_id', $forum->id)
        ->where('likeable_type', get_class($forum))
        ->where('user_id', $this->id)
        ->count();
    }

  	public function hasLikedThreadReply(ForumsDesc $reply)
    {
      return (bool) $reply->likes
        ->where('likeable_id', $reply->id)
        ->where('likeable_type', get_class($reply))
        ->where('user_id', $this->id)
        ->count();
    }


  	public function contact()
    {
      return $this->hasOne(Contact::class);
    }

  	public function shop()
    {
      return $this->hasMany(Shop::class);
    }

  	public function quiz()
    {
      return $this->hasMany(Quiz::class);
    }

  	public function quizScore()
    {
      return $this->hasOne(QuizScore::class);
    }
  	/**
    *
    * Thread by User
    */
  	public function thread()
    {
      return $this->hasMany(Forum::class);
    }

  	/**
    *
    * Comment by user
    */
  	public function comment()
    {
      return $this->hasMany(ForumsDesc::class);
    }

  	public function gallerycomment()
    {
      return $this->hasMany(GalleryComment::class);
    }

  	/**
    *
    * User gallery
    */
  	public function gallery()
    {
      return $this->hasMany(Gallery::class);
    }

}