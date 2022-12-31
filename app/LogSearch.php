<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LogSearch
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $q
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch whereQ($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSearch whereUserId($value)
 *
 * @mixin \Eloquent
 */
class LogSearch extends Model
{
    protected $fillable = [
        'user_id', 'q',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
