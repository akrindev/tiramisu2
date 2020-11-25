<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $guarded = [];

    protected $casts = [
    	'body'	=> 'json'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_formula', 'formula_id', 'user_id')->using(UserFormula::class);
    }

    /**
     * Scope a query to only exclude specific Columns
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExclude($query, ...$columns)
    {
        return $query->select( array_diff( $this->getTableColumns(),$columns) );
    }

    /**
     * Shows All the columns of the Corresponding Table of Model
     *
     * @author Manojkiran.A <manojkiran10031998@gmail.com>
     * If You need to get all the Columns of the Model Table.
     * Useful while including the columns in search
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