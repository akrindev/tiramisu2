<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cooking
 *
 * @property int $id
 * @property string|null $name
 * @property string $buff
 * @property int $stat
 * @property int|null $pt
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereBuff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking wherePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cooking whereStat($value)
 * @mixin \Eloquent
 */
class Cooking extends Model
{
  protected $fillable = [
  	'name', 'buff', 'stat', 'pt'
  ];

  public $timestamps = false;

  public function user()
  {
    return $this->hasOne(User::class);
  }
}