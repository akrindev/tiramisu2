<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContributionDrop extends Model
{
  protected $fillable = [
  	'user_id', 'drop_id', 'name',
    'body', 'picture', 'accepted'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function drop()
  {
    return $this->belongsTo(Drop::class);
  }
}