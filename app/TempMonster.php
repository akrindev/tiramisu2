<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempMonster extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $with = ['map'];

    public function monster()
    {
        return $this->belongsTo(Monster::class);
    }

    public function drops()
    {
        return $this->belongsToMany(Drop::class, 'temp_monster_drop');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
