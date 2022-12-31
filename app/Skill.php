<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Skill
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $picture
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SkillList[] $child
 * @property-read int|null $child_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereType($value)
 *
 * @mixin \Eloquent
 */
class Skill extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name', 'type', 'picture', 'description',
    ];

    public function child()
    {
        return $this->hasMany(SkillList::class, 'skill_id');
    }
}
