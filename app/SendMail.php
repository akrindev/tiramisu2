<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SendMail
 *
 * @property int $id
 * @property string $subject
 * @property int|null $user_id
 * @property string $body
 * @property string|null $sender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail query()
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SendMail whereUserId($value)
 *
 * @mixin \Eloquent
 */
class SendMail extends Model
{
    protected $fillable = [
        'subject', 'user_id', 'body', 'sender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyAttribute($value)
    {
        return e(toHtml($value));
    }
}
