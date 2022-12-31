<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TempMonster
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $monster_id
 * @property int $approved
 * @property int $map_id
 * @property int $element_id
 * @property string $name
 * @property string $name_en
 * @property int $level
 * @property int $type
 * @property int|null $hp
 * @property int|null $xp
 * @property string $pet
 * @property string|null $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Drop[] $drops
 * @property-read int|null $drops_count
 * @property-read \App\Element|null $element
 * @property-read \App\Map|null $map
 * @property-read \App\Monster|null $monster
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster query()
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereMapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereMonsterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster wherePet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempMonster whereXp($value)
 *
 * @mixin \Eloquent
 */
class TempMonster extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $with = ['map'];

    public function monster()
    {
        return $this->belongsTo(Monster::class);
    }

    public function drops()
    {
        return $this->belongsToMany(Drop::class, 'temp_monster_drop');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
