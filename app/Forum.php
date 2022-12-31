<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Traits\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Forum
 *
 * @property int $id
 * @property int $user_id
 * @property string $judul
 * @property string $body
 * @property string $slug
 * @property string $tags
 * @property string $color
 * @property int $views
 * @property int $pinned
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $forum_category_id
 * @property-read \App\ForumCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ForumsDesc[] $comment
 * @property-read int|null $comment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Forum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Forum newQuery()
 * @method static \Illuminate\Database\Query\Builder|Forum onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Forum query()
 * @method static \Illuminate\Database\Eloquent\Builder|Forum search($column, $key)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereForumCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum wherePinned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forum whereViews($value)
 * @method static \Illuminate\Database\Query\Builder|Forum withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Forum withoutTrashed()
 * @mixin \Eloquent
 */
class Forum extends Model implements Auditable
{
  use SoftDeletes, Notifiable, Searchable, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'judul', 'body' , 'pinned',
        'slug', 'tags', 'views', 'color',
        'forum_category_id'
    ];

    protected $with = [
        'category', 'user', 'comment', 'likes'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function category()
  {
    return $this->belongsTo(ForumCategory::class, 'forum_category_id')
      ->withDefault([
        	'name'	=> 'Diskusi Umum',
          	'slug'	=> 'diskusi-umum'
        ]);
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
