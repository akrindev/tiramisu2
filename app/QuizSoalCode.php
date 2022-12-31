<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuizSoalCode
 *
 * @property int $id
 * @property int $quiz_code_id
 * @property string $body
 * @property string $soal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\QuizCode|null $quizCode
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode whereQuizCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode whereSoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizSoalCode whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class QuizSoalCode extends Model
{
    protected $fillable = [
        'body', 'soal',
    ];

    public function quizCode()
    {
        return $this->belongsTo(QuizCode::class);
    }
}
