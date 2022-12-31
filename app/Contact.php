<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $line
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $whatsapp
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereWhatsapp($value)
 *
 * @mixin \Eloquent
 */
class Contact extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getWhatsappAttribute($value)
    {
        return is_null($value) ? null : preg_replace('/(^[0])/', '+62', $value);
    }
}
