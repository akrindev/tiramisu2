<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MonthlyDye
 *
 * @property int $id
 * @property int $monster_id
 * @property int $dye_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Dye|null $dye
 * @property-read \App\Monster|null $monster
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye query()
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye whereDyeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye whereMonsterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonthlyDye whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MonthlyDye extends Model
{
    protected $guarded = [];

    public function monster()
    {
        return $this->belongsTo(Monster::class);
    }

    public function dye()
    {
        return $this->belongsTo(Dye::class);
    }
}
