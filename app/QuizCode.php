<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizCode extends Model
{
    public function soal()
    {
      return $this->hasOne(QuizSoalCode::class);
    }

  	public function user()
    {
      return $this->belongsTo(User::class);
    }

  	public function quizScore()
    {
      return $this->hasMany(QuizScoreCode::class);
    }
}