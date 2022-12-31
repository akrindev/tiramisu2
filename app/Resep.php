<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Resep
 *
 * @property int $id
 * @property int $drop_id
 * @property string $material
 * @property string $jumlah
 * @property int|null $fee
 * @property int|null $level
 * @property int|null $diff
 * @property int|null $set
 * @property int|null $pot
 * @property int|null $base
 * @property-read \App\Drop|null $drop
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Resep newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resep newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resep query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereDiff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep wherePot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resep whereSet($value)
 *
 * @mixin \Eloquent
 */
class Resep extends Model
{
    protected $fillable = [
        'drop_id', 'material', 'jumlah',
        'fee', 'level', 'diff', 'set', 'pot', 'base',
    ];

    public $timestamps = false;

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }
}
