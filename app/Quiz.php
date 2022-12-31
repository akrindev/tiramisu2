<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Quiz
 *
 * @property int $id
 * @property int $user_id
 * @property string $question
 * @property string $answer_a
 * @property string $answer_b
 * @property string $answer_c
 * @property string $answer_d
 * @property string $correct
 * @property int $approved
 * @property int $views
 * @property int $benar
 * @property int $salah
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereAnswerA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereAnswerB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereAnswerC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereAnswerD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereBenar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereSalah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereViews($value)
 *
 * @mixin \Eloquent
 */
class Quiz extends Model
{
    protected $fillable = [
        'user_id', 'question',
        'answer_a', 'answer_b', 'answer_c', 'answer_d',
        'correct', 'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
