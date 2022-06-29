<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BgMusicComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $bg_music_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\BgMusic|null $bgMusic
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment whereBgMusicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BgMusicComment whereUserId($value)
 * @mixin \Eloquent
 */
class BgMusicComment extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function bgMusic()
    {
        return $this->belongsTo(BgMusic::class);
    }
}
