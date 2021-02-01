<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registled extends Model
{
    use HasFactory;

	protected $guarded = [];

	public $casts = [
		'recommended_lv' => 'array',
		'box'	=> 'array',
	];

	public function drop()
	{
		return $this->belongsTo(Drop::class);
	}
}