<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserGuild extends Pivot
{
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
