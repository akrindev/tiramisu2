<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

use App;

/**
 * App\Monster
 *
 * @property int $id
 * @property int $map_id
 * @property int $element_id
 * @property string $name
 * @property string|null $name_en
 * @property int $level
 * @property int $type
 * @property int|null $hp
 * @property int|null $xp
 * @property string $pet
 * @property string|null $picture
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Drop[] $drops
 * @property-read int|null $drops_count
 * @property-read \App\Element|null $element
 * @property-read \App\Map|null $map
 * @method static \Illuminate\Database\Eloquent\Builder|Monster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monster query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monster search($column, $key)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereMapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster wherePet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereXp($value)
 * @mixin \Eloquent
 */
class Monster extends Model
{
    use Searchable;

    protected $guarded = [];

    protected $with = ['element'];

    public $timestamps = false;

    public function drops()
    {
        return $this->belongsToMany(Drop::class, 'monster_drop');
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function element()
    {
        return $this->belongsTo(Element::class);
    }

    /*
  // attributes
  */
    public function getHpAttribute($value)
    {
        return is_null($value) ? null : number_format($value);
    }

    public function getNameAttribute()
    {
        if (App::isLocale('en')) {
            return $this->attributes['name_en'];
        }

        return $this->attributes['name'];
    }
}
