<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
  protected $fillable = [
  	'drop_id', 'material', 'jumlah',
    'fee', 'level', 'diff', 'set', 'pot', 'base'
  ];
  public $timestamps = false;

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }
}