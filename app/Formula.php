<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $guarded = [];

    protected $casts = [
    	'body'	=> 'json'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}