<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TempDrop
 *
 * @property int $id
 * @property int|null $drop_id
 * @property int $drop_type_id
 * @property int|null $user_id
 * @property int $approved
 * @property string $name
 * @property string $name_en
 * @property array|null $note
 * @property string|null $picture
 * @property string|null $fullimage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Drop|null $drop
 * @property-read \App\DropType|null $dropType
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop query()
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereDropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereDropTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereFullimage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempDrop whereUserId($value)
 * @mixin \Eloquent
 */
class TempDrop extends Model
{
    use HasFactory;

    protected $guarded = [];

  	protected $casts = [
    	'note'	=> 'json'
    ];

    protected $with = ['dropType'];

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }

  	public function dropType()
    {
        return $this->belongsTo(DropType::class);
    }

  	public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'guest'
        ]);
    }
}
