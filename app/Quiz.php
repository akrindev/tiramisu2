<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
    	'user_id', 'question',
        'answer_a','answer_b','answer_c','answer_d',
      	'correct', 'approved'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }
}