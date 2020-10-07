<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvatarList extends Model
{
    protected $guarded = [];

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'avatar_avatar_lists', 'avatar_list_id', 'avatar_id');
    }
}