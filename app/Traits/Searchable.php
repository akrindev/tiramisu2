<?php

namespace App\Traits;

trait Searchable
{
  public function scopeSearch($query, $table, $key)
  {
    return $query->where($table, 'like', '%'. $key . '%');
  }
}