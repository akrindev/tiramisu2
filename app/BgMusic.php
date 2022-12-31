<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BgMusic
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $video_id
 * @property string $channel_title
 * @property string $channel_id
 * @property string $pada
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BgMusicComment[] $comments
 * @property-read int|null $comments_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic query()
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereChannelTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic wherePada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusic whereVideoId($value)
 *
 * @mixin \Eloquent
 */
class BgMusic extends Model
{
    protected $table = 'bg_musics';

    public function comments()
    {
        return $this->hasMany(BgMusicComment::class);
    }
}
