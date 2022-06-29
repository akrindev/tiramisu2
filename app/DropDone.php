<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DropDone
 *
 * @property int $id
 * @property int $drop_id
 * @property-read \App\Drop|null $drop
 * @method static \Illuminate\Database\Eloquent\Builder|DropDone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DropDone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DropDone query()
 * @method static \Illuminate\Database\Eloquent\Builder|DropDone whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DropDone whereId($value)
 * @mixin \Eloquent
 */
class DropDone extends Model
{
  protected $table = 'drop_done';
  protected $fillable = [
  	'drop_id'
  ];
  public $timestamps = false;

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }
}