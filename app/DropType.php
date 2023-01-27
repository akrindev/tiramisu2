<?php

namespace App;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * App\DropType
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Drop[] $drop
 * @property-read int|null $drop_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DropType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DropType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DropType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DropType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DropType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DropType whereUrl($value)
 *
 * @mixin \Eloquent
 */
class DropType extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function drop()
    {
        return $this->hasMany(Drop::class, 'drop_type_id');
    }

    public function url(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value ? url($value) : null
        );
    }
}
