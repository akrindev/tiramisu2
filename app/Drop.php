<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App;
use App\Traits\Searchable;

/**
 * App\Drop
 *
 * @property int $id
 * @property int $drop_type_id
 * @property string $name
 * @property string|null $name_en
 * @property int|null $proses
 * @property int|null $sell
 * @property array|null $note
 * @property string|null $picture
 * @property string|null $fullimage
 * @property string|null $released
 * @property-read \App\DropDone|null $dropDone
 * @property-read \App\DropType|null $dropType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NpcReward[] $fromQuest
 * @property-read int|null $from_quest_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Monster[] $monsters
 * @property-read int|null $monsters_count
 * @property-read \App\Registled|null $registled
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Resep[] $resep
 * @property-read int|null $resep_count
 * @method static \Illuminate\Database\Eloquent\Builder|Drop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Drop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Drop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Drop search($column, $key)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereDropTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereFullimage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereProses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereReleased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Drop whereSell($value)
 * @mixin \Eloquent
 */
class Drop extends Model
{
  	use Searchable;

  	protected $casts = [
    	'note'	=> 'json'
    ];

    protected $with = [
        'dropType',
        'monsters'
    ];

    protected $guarded = [];

  	public $timestamps = false;

  	public function dropType()
    {
      return $this->belongsTo(DropType::class);
    }

  	public function monsters()
    {
      return $this->belongsToMany(Monster::class, 'monster_drop');
    }

	public function registled()
	{
		return $this->hasOne(Registled::class);
	}

  	public function resep()
    {
      return $this->hasMany(Resep::class);
    }

  	public function fromQuest()
    {
      return $this->hasMany(NpcReward::class);
    }

  	public function dropDone()
    {
      return $this->hasOne(DropDone::class, 'drop_id');
    }

  	public function getNameAttribute()
    {
        if(App::isLocale('en')) {
            return $this->attributes['name_en'];
        }

        return $this->attributes['name'];
    }

}