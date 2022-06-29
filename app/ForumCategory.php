<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ForumCategory
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Forum[] $forum
 * @property-read int|null $forum_count
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ForumCategory extends Model
{
    protected $guarded = [];

  	public function forum()
    {
      return $this->hasMany(Forum::class);
    }
}