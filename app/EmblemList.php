<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\EmblemList
 *
 * @property int $id
 * @property int $emblem_id
 * @property string $name
 * @property string $body
 * @property string $reward
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $update
 * @property-read \App\Emblem|null $emblem
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereEmblemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmblemList whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class EmblemList extends Model
{
    protected $fillable = [
        'name', 'body', 'reward', 'update',
    ];

    public function emblem()
    {
        return $this->belongsTo(Emblem::class);
    }
}
