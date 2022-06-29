<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AvatarList
 *
 * @property int $id
 * @property string $title
 * @property string $title_en
 * @property int $type
 * @property int $rate
 * @property string $value
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Avatar[] $avatars
 * @property-read int|null $avatars_count
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList query()
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvatarList whereValue($value)
 * @mixin \Eloquent
 */
class AvatarList extends Model
{
    protected $guarded = [];

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'avatar_avatar_lists', 'avatar_list_id', 'avatar_id');
    }
}