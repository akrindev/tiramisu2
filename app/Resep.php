<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
  protected $fillable = [
  	'drop_id', 'material', 'jumlah'
  ];
  public $timestamps = false;

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }
}