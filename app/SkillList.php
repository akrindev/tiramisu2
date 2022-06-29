<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SkillList
 *
 * @property int $id
 * @property int $skill_id
 * @property string $name
 * @property string $type
 * @property int|null $element_id
 * @property string $for
 * @property int|null $mp
 * @property int|null $range
 * @property int $level
 * @property string $combo_awal
 * @property string $combo_tengah
 * @property string|null $description
 * @property string|null $picture
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SkillComment[] $comment
 * @property-read int|null $comment_count
 * @property-read \App\Element|null $element
 * @property-read \App\Skill|null $skill
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList query()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereComboAwal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereComboTengah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereMp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillList whereType($value)
 * @mixin \Eloquent
 */
class SkillList extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'skill_id', 'name', 'type', 'element_id',
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