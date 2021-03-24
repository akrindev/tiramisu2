<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
