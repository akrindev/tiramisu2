<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Npc
 *
 * @property int $id
 * @property string $name
 * @property int $map_id
 * @property string|null $picture
 * @property-read \App\Map|null $map
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NpcQuest[] $quest
 * @property-read int|null $quest_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Npc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Npc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Npc query()
 * @method static \Illuminate\Database\Eloquent\Builder|Npc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Npc whereMapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Npc whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Npc wherePicture($value)
 *
 * @mixin \Eloquent
 */
class Npc extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name', 'map_id', 'picture',
    ];

    public function quest()
    {
        return $this->hasMany(NpcQuest::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}
