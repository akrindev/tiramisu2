<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NpcReward
 *
 * @property int $id
 * @property int $npc_quest_id
 * @property int $drop_id
 * @property int $many
 * @property-read \App\Drop|null $drop
 * @property-read \App\NpcQuest|null $quest
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward query()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward whereMany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcReward whereNpcQuestId($value)
 * @mixin \Eloquent
 */
class NpcReward extends Model
{
  public $timestamps = false;
  public $fillable = [
  	'drop_id', 'many'
  ];

  public function quest()
  {
    return $this->belongsTo(NpcQuest::class,'npc_quest_id');
  }

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }
}