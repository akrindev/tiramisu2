<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Guild
 *
 * @property int $id
 * @property int $manager_id
 * @property string $name
 * @property string $logo
 * @property string|null $description
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Guild newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guild newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guild query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guild whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Guild extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = [
        'manager', 'users'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_guild')
                    ->using(UserGuild::class)
                    ->withPivot(['role', 'accept', 'manager_id']);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function canManageGuild($id, $opt = null)
    {
        $role = $this->users()->wherePivot('user_id', $id)->first();

        if(! $role) {
            return false;
        }

        $roles = ['wakil', 'ketua'];

        if (! is_null($opt)) {
            \array_push($roles, $opt);
        }


        return \in_array($role->pivot->role, $roles);
    }

    public function isManager()
    {
        return auth()->id() == $this->manager_id;
    }
}
