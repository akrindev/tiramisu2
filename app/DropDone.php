<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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