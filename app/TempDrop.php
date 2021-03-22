<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDrop extends Model
{
    use HasFactory;

    protected $guarded = [];

  	protected $casts = [
    	'note'	=> 'json'
    ];

    protected $with = ['dropType'];

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }

  	public function dropType()
    {
        return $this->belongsTo(DropType::class);
    }

  	public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'guest'
        ]);
    }
}
