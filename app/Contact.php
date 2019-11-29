<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $fillable = [
  	'user_id', 'line', 'whatsapp'
  ];

  public function getWhatsappAttribute($value)
  {
    return is_null($value) ? null : preg_replace('/(^[0])/', '+62', $value);
  }
}