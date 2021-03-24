<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $guarded = [];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function getWhatsappAttribute($value)
  {
    return is_null($value) ? null : preg_replace('/(^[0])/', '+62', $value);
  }
}
