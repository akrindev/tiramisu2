<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NpcTujuan
 *
 * @property int $id
 * @property int $npc_quest_id
 * @property int $defeat
 * @property int|null $drop_id
 * @property int|null $monster_id
 * @property int $many
 * @property-read \App\Drop|null $drop
 * @property-read \App\Monster|null $monster
 * @property-read \App\NpcQuest|null $quest
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan query()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan whereDefeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan whereMany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan whereMonsterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcTujuan whereNpcQuestId($value)
 * @mixin \Eloquent
 */
class NpcTujuan extends Model
{
  protected $table = 'npc_tujuan';
  public $timestamps = false;
  public $fillable = [
  	'defeat', 'drop_id', 'monster_id', 'many'
  ];

  public function quest()
  {
    return $this->belongsTo(NpcQuest::class);
  }

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }

  public function monster()
  {
    return $this->belongsTo(Monster::class);
  }
}