<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contribution
 *
 * @property int $id
 * @property int $user_id
 * @property int $point
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribution whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Contribution extends Model
{
    protected $fillable = [
        'user_id', 'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
