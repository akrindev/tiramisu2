<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizScoreCode extends Model
{
    protected $fillable = [
    	'user_id', 'quiz_code_id', 'benar', 'salah?'
    ];

  	public function quizCode()
    {
    	return $this->belongsTo(QuizCode::class);
    }

  	public function user()
    {
      return $this->belongsTo(User::class);
    }
}