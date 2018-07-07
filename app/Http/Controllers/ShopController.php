<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\ShopCat;
use Image;

class ShopController extends Controller
{
  	public function discover()
    {
      $shops = Shop::paginate(20);

      return view('shop.discover',[
      	'data'	=> $shops
      ]);
    }

  	public function show($slug)
    {
      $shop = Shop::where('slug',$slug)->firstOrFail();
      $rands = Shop::inRandomOrder()->take(5)->get();

      $shop->increment('views');

      return view('shop.show',[
      	'data'	=> $shop,
        'rand'	=> $rands
      ]);
    }

    public function jual()
    {
      $cats = ShopCat::all();

      return view('shop.jual',[
      	'kategori'	=> $cats
      ]);
    }

  	public function jualSubmit()
    {
      request()->validate([
      	'nama'	=> 'required|min:2|max:140',
        'harga'	=> 'required|numeric',
        'deskripsi' => 'required|min:5',
        'screenshot' => 'required|image|mimes:jpg,png,gif,jpeg',
        'kategori' => 'required|numeric'
      ]);


      if(request()->hasFile('screenshot'))
      {
        $gambar = request()->file('screenshot');

        $name = substr(md5(now()),0,8).'.png';

        Image::make($gambar->path())
          ->insert(public_path().'/img/up-on.png')
          ->save(public_path().'/uploads/'.$name);

        $Cupload = new CUpload;
        $up = $Cupload->upload(public_path().'/uploads/'.$name);

        unlink(public_path().'/uploads/'.$name);

        $url_img = $up['secure_url'];
      }

      $slug = str_random(5).'-'.str_slug(request()->nama.'-'.now());

      $insert = Shop::create([
      	'user_id'	=> auth()->id(),
        'nama_barang'	=> request()->nama,
        'harga'		=> request()->harga,
        'deskripsi'	=> request()->deskripsi,
        'gambar'	=> $url_img,
        'slug'		=> $slug,
        'cat_id'	=> request()->kategori
      ]);

      if($insert)
      {
        return redirect('/shop/show/'.$slug);
      }
    }
}