<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Fcm
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fcm whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Fcm extends Model
{
    protected $table = 'fcm_tokens';

    protected $fillable = [
        'user_id', 'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
