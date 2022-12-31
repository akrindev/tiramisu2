<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Registled
 *
 * @property int $id
 * @property int $drop_id
 * @property int|null $max_level
 * @property array|null $recommended_lv
 * @property array|null $box
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Drop|null $drop
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Registled newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registled newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registled query()
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereBox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereMaxLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereRecommendedLv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registled whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Registled extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $casts = [
        'recommended_lv' => 'array',
        'box' => 'array',
    ];

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }
}
