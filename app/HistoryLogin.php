<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HistoryLogin
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip
 * @property string $browser
 * @property string|null $extra
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoryLogin whereUserId($value)
 * @mixin \Eloquent
 */
class HistoryLogin extends Model
{
  protected $fillable = [
  	'ip', 'browser', 'extra'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}