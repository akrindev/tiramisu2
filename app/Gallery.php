<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Gallery
 *
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property string $gambar
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GalleryComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newQuery()
 * @method static \Illuminate\Database\Query\Builder|Gallery onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereViews($value)
 * @method static \Illuminate\Database\Query\Builder|Gallery withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Gallery withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Gallery extends Model
{
    use SoftDeletes, Notifiable;

    protected $fillable = [
        'user_id', 'body', 'gambar',
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
