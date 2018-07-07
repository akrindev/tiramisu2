<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
    	'user_id', 'nama_barang', 'harga',
      	'deskripsi', 'laku', 'gambar',
      	'slug','cat_id'
    ];

  	public function user()
    {
      return $this->belongsTo(User::class);
    }
}