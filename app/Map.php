<?php

namespace App;

use App;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Map
 *
 * @property int $id
 * @property string $name
 * @property string|null $name_en
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Monster[] $monster
 * @property-read int|null $monster_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Npc[] $npc
 * @property-read int|null $npc_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Map newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Map newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Map query()
 * @method static \Illuminate\Database\Eloquent\Builder|Map search($column, $key)
 * @method static \Illuminate\Database\Eloquent\Builder|Map whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Map whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Map whereNameEn($value)
 *
 * @mixin \Eloquent
 */
class Map extends Model
{
    use Searchable;

    protected $fillable = [
        'name', 'name_en',
    ];

    public $timestamps = false;

    public function monster()
    {
        return $this->hasMany(Monster::class);
    }

    public function npc()
    {
        return $this->hasMany(Npc::class);
    }

    public function getNameAttribute()
    {
        if (App::isLocale('en')) {
            return $this->attributes['name_en'];
        }

        return $this->attributes['name'];
    }
}
