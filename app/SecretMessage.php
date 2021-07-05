<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
