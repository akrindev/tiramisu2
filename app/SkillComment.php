<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SkillComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $skill_list_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment whereSkillListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillComment whereUserId($value)
 * @mixin \Eloquent
 */
class SkillComment extends Model
{
  public $fillable = [
  	'user_id', 'skill_list_id', 'body'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function notify($notify)
  {
    return $this->user->notify($notify);
  }
}