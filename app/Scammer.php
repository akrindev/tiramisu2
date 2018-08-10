<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scammer extends Model
{
  	use SoftDeletes;

  	public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function picture()
    {
      return $this->hasMany(ScammerPic::class);
    }

  	public function comment()
    {
      return $this->hasMany(ScammerComment::class);
    }

  	public function kategori()
    {
      return $this->belongsTo(CatScammer::class, 'cat_scammer_id');
    }

    public function notify($notify)
    {
      return $this->user->notify($notify);
    }
}