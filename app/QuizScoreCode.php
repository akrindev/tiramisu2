<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuizScoreCode
 *
 * @property int $id
 * @property int $user_id
 * @property int $quiz_code_id
 * @property int $benar
 * @property int $salah
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\QuizCode|null $quizCode
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereBenar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereQuizCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereSalah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScoreCode whereUserId($value)
 * @mixin \Eloquent
 */
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