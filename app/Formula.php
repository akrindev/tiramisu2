<?php

namespace App;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Formula
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $note
 * @property string $final_step
 * @property array $body
 * @property int $starting_pot
 * @property int $highest_mats
 * @property string $type
 * @property int $success_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Formula exclude(...$columns)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formula newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formula query()
 * @method static \Illuminate\Database\Eloquent\Builder|Formula search($column, $key)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereFinalStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereHighestMats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereStartingPot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereSuccessRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formula whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Formula extends Model implements Auditable
{
    use Searchable, \OwenIt\Auditing\Auditable;

    /**
     * Auditable events.
     *
     * @var array
     */
    protected $auditEvents = [
        'updated',
        'deleted',
        'restored',
    ];

    protected $guarded = [];

    protected $casts = [
        'body' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_formula', 'formula_id', 'user_id')->using(UserFormula::class);
    }

    /**
     * Scope a query to only exclude specific Columns
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExclude($query, ...$columns)
    {
        return $query->select(array_diff($this->getTableColumns(), $columns));
    }

    /**
     * Shows All the columns of the Corresponding Table of Model
     *
     * @author Manojkiran.A <manojkiran10031998@gmail.com>
     * If You need to get all the Columns of the Model Table.
     * Useful while including the columns in search
     *
     * @return array
     **/
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function getTypeAttribute()
    {
        return $this->attributes['type'] === 'w' ? 'Weapon' : 'Armor';
    }
}
