<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ContributionDrop
 *
 * @property int $id
 * @property int $user_id
 * @property int $drop_id
 * @property string $name
 * @property string|null $picture
 * @property int $accepted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Drop|null $drop
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContributionDrop whereUserId($value)
 *
 * @mixin \Eloquent
 */
class ContributionDrop extends Model
{
    protected $fillable = [
        'user_id', 'drop_id', 'name',
        'body', 'picture', 'accepted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }
}
