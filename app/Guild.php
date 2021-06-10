<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
