<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuizCode
 *
 * @property int $id
 * @property int $user_id
 * @property int $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\QuizScoreCode[] $quizScore
 * @property-read int|null $quiz_score_count
 * @property-read \App\QuizSoalCode|null $soal
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizCode whereUserId($value)
 * @mixin \Eloquent
 */
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