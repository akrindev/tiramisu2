<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSoalCode extends Model
{
    protected $fillable = [
    	'body', 'soal'
    ];

  	public function quizCode()
    {
      return $this->belongsTo(QuizCode::class);
    }
}