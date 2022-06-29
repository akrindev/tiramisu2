<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\UserGuild
 *
 * @property int $user_id
 * @property int $guild_id
 * @property string $role
 * @property int|null $manager_id
 * @property int $accept
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereAccept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereGuildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGuild whereUserId($value)
 * @mixin \Eloquent
 */
class UserGuild extends Pivot
{
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
