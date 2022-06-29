<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuizScore
 *
 * @property int $id
 * @property int $user_id
 * @property int $benar
 * @property int $salah
 * @property int $point
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Quiz|null $quiz
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore whereBenar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore whereSalah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizScore whereUserId($value)
 * @mixin \Eloquent
 */
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