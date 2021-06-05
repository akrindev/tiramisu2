<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = [
        'manager'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_guild')->withPivot(['role', 'accept']);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function canManageGuild()
    {
        //
    }
}
