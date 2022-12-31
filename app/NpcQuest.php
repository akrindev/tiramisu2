<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NpcQuest
 *
 * @property int $id
 * @property int $npc_id
 * @property string $name
 * @property int|null $level
 * @property int|null $exp
 * @property string|null $detail
 * @property-read \App\Npc|null $npc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NpcReward[] $reward
 * @property-read int|null $reward_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NpcTujuan[] $tujuan
 * @property-read int|null $tujuan_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest query()
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest whereExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NpcQuest whereNpcId($value)
 *
 * @mixin \Eloquent
 */
class NpcQuest extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name', 'npc_id', 'level', 'exp', 'detail',
    ];

    public function npc()
    {
        return $this->belongsTo(Npc::class);
    }

    public function tujuan()
    {
        return $this->hasMany(NpcTujuan::class);
    }

    public function reward()
    {
        return $this->hasMany(NpcReward::class);
    }
}
