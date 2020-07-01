<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'name', 'type', 'picture', 'description'
  ];

  public function child()
  {
    return $this->hasMany(SkillList::class, 'skill_id');
  }
}