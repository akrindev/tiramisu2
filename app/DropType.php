<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropType extends Model
{
  public function drop()
  {
    return $this->hasMany(Drop::class, 'drop_type_id');
  }
}