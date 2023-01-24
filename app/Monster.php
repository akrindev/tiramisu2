<?php

namespace App;

use App;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

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
 *
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
 *
 * @mixin \Eloquent
 */
class Monster extends Model implements Auditable
{
    use Searchable, SoftDeletes, \OwenIt\Auditing\Auditable;

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

    public function picture(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value ? url($value) : null
        );
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


    public function routes(): Attribute
    {
        return new Attribute(
            get: fn ($value) => url('/monster/' . $this->attributes['id'])
        );
    }
}
