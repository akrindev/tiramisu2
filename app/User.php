<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Forum;
use App\ForumsDesc;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

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

    public function isTopContributor()
    {
        $topContributor = Contribution::orderByDesc('point')->take(10)->pluck('user_id')->toArray();

        return auth()->check() && ($this->isAdmin() || \in_array(auth()->id(), $topContributor));
    }

	public function getAvatar()
	{
		if(!is_null($this->attributes['provider_id'])) {
			return "https://graph.facebook.com/{$this->attributes['provider_id']}/picture?type=normal";
		}

		return $this->attributes['avatar'];
	}

  	public function fcm()
    {
      return $this->hasOne(Fcm::class);
    }

  	public function historyLogin()
    {
      return $this->hasMany(HistoryLogin::class);
    }

  	/**
    *
    * User likes
    */
  	public function likes()
    {
      return $this->morphMany(Like::class, 'likeable');
    }

  	public function myLovedThread()
    {
      return $this->hasMany(Like::class);
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

  	public function quiz()
    {
      return $this->hasMany(Quiz::class);
    }

  	public function quizScore()
    {
      return $this->hasOne(QuizScore::class);
    }

  	public function quizCode()
    {
      return $this->hasMany(QuizCode::class);
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

  	/**
    * User Contribution
    */
  	public function contribution()
    {
      return $this->hasOne(Contribution::class);
    }

  	public function contributionDrop()
    {
      return $this->hasMany(ContributionDrop::class);
    }

  	/**
    * User hasOne Cooking
    */
  	public function cooking()
    {
      return $this->belongsTo(Cooking::class);
    }

    public function secondCooking()
    {
      return $this->belongsTo(Cooking::class, 'second_cooking_id');
    }

    /*
    *
    * user has many saved formula
    */
    public function formulas()
    {
        return $this->hasMany(Formula::class);
    }

    // user saved formula
    public function savedFormulas()
    {
      return $this->belongsToMany(Formula::class, 'user_formula', 'user_id', "formula_id")->using(UserFormula::class);
    }

    // guild
    public function guilds()
    {
        return $this->belongsToMany(Guild::class, 'user_guild');
    }
}
