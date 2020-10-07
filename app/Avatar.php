<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $guarded = [];

    public function lists()
    {
        return $this->belongsToMany(AvatarList::class, 'avatar_avatar_lists', 'avatar_id', 'avatar_list_id');
    }
}