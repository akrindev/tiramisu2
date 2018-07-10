<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    protected $fillable = [
    	'user_id', 'benar', 'salah', 'point'
    ];

  	public function quiz()
    {
      return $this->belongsTo(Quiz::class);
    }

  	public function user()
    {
      return $this->belongsTo(User::class);
    }
}