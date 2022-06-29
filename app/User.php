<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Forum;
use App\ForumsDesc;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $provider_id
 * @property string|null $twitter_id
 * @property string|null $username
 * @property string|null $avatar
 * @property string|null $link
 * @property string $biodata
 * @property int $banned
 * @property int $subscribe
 * @property string $ign
 * @property string $alamat
 * @property string $gender
 * @property string $role
 * @property int $changed
 * @property int|null $cooking_id
 * @property int|null $second_cooking_id
 * @property int|null $second_cooking_level
 * @property int|null $cooking_level
 * @property int $visibility
 * @property string|null $remember_token
 * @property string|null $deletion_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|ForumsDesc[] $comment
 * @property-read int|null $comment_count
 * @property-read \App\Contact|null $contact
 * @property-read \App\Contribution|null $contribution
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ContributionDrop[] $contributionDrop
 * @property-read int|null $contribution_drop_count
 * @property-read \App\Cooking|null $cooking
 * @property-read \App\Fcm|null $fcm
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Formula[] $formulas
 * @property-read int|null $formulas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Gallery[] $gallery
 * @property-read int|null $gallery_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GalleryComment[] $gallerycomment
 * @property-read int|null $gallerycomment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Guild[] $guilds
 * @property-read int|null $guilds_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HistoryLogin[] $historyLogin
 * @property-read int|null $history_login_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $myLovedThread
 * @property-read int|null $my_loved_thread_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Quiz[] $quiz
 * @property-read int|null $quiz_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\QuizCode[] $quizCode
 * @property-read int|null $quiz_code_count
 * @property-read \App\QuizScore|null $quizScore
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Formula[] $savedFormulas
 * @property-read int|null $saved_formulas_count
 * @property-read \App\Cooking|null $secondCooking
 * @property-read \Illuminate\Database\Eloquent\Collection|Forum[] $thread
 * @property-read int|null $thread_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBiodata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereChanged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCookingLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIgn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSecondCookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSecondCookingLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubscribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVisibility($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
        return $this->belongsToMany(Guild::class, 'user_guild')
                    ->using(UserGuild::class)
                    ->withPivot(['role', 'accept', 'manager_id']);
    }
}
