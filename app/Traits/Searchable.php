<?php

namespace App\Traits;

trait Searchable
{
    public function scopeSearch($query, $column, $key)
    {
        return $query->where($column, 'like', '%'.$key.'%');
    }
}
