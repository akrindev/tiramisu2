<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillList extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'skill_id', 'name', 'r_name', 'type', 'element_id',
    'for', 'mp', 'range', 'level',
    'combo_awal', 'combo_tengah', 'description', 'picture'
  ];

  public function skill()
  {
    return $this->belongsTo(Skill::class);
  }

  public function element()
  {
    return $this->belongsTo(Element::class);
  }

  public function comment()
  {
    return $this->hasMany(SkillComment::class);
  }
}