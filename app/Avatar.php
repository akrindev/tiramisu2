<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Avatar
 *
 * @property int $id
 * @property string $title
 * @property string|null $title_en
 * @property string $cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AvatarList[] $lists
 * @property-read int|null $lists_count
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Avatar extends Model
{
    protected $guarded = [];

    public function lists()
    {
        return $this->belongsToMany(AvatarList::class, 'avatar_avatar_lists', 'avatar_id', 'avatar_list_id');
    }
}