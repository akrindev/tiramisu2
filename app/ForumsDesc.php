<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\ForumsDesc
 *
 * @property int $id
 * @property int $user_id
 * @property int $forum_id
 * @property int|null $parent_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Forum|null $forum
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereForumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumsDesc whereUserId($value)
 *
 * @mixin \Eloquent
 */
class ForumsDesc extends Model implements Auditable
{
    use Notifiable, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'forum_id', 'body', 'parent_id',
    ];

    protected $with = [
        'user', 'likes', 'getReply',
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
        return $this->hasMany(ForumsDesc::class, 'parent_id');
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
