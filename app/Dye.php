<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Dye
 *
 * @property int $id
 * @property int $color
 * @property string $hex
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Dye newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dye newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dye query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dye whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dye whereHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dye whereId($value)
 *
 * @mixin \Eloquent
 */
class Dye extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
