<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SecretMessage
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property int $privacy
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|SecretMessage[] $reply
 * @property-read int|null $reply_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage publicMessage()
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage wherePrivacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecretMessage whereUserId($value)
 * @mixin \Eloquent
 */
class SecretMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $with = [
        'reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublicMessage($query)
    {
        return $query->where('privacy', 1)->where('parent_id', null);
    }

    public function reply()
    {
        return  $this->hasMany(SecretMessage::class, 'parent_id');
    }
}
