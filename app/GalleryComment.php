<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GalleryComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $gallery_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gallery|null $gallery
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment whereGalleryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryComment whereUserId($value)
 * @mixin \Eloquent
 */
class GalleryComment extends Model
{
    protected $fillable = [
    	'user_id', 'body'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
