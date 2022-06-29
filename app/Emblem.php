<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Emblem
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EmblemList[] $child
 * @property-read int|null $child_count
 * @method static \Illuminate\Database\Eloquent\Builder|Emblem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Emblem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Emblem query()
 * @method static \Illuminate\Database\Eloquent\Builder|Emblem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Emblem whereName($value)
 * @mixin \Eloquent
 */
class Emblem extends Model
{
  protected $fillable = [
  	'name'
  ];

  public $timestamps = false;

  public function child()
  {
    return $this->hasMany(EmblemList::class, 'emblem_id');
  }
}