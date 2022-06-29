<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FillStat
 *
 * @property int $id
 * @property int $type
 * @property int $plus
 * @property string $stats
 * @property string $steps
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat wherePlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat whereStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat whereSteps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FillStat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FillStat extends Model
{
    protected $fillable = [
    	'type', 'plus',
      	'stats', 'steps'
    ];
}