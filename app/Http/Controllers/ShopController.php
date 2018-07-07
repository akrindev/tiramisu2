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

  	public function edit($slug)
    {
      $shop = Shop::where('slug',$slug)->firstOrFail();
      $cats = ShopCat::all();

      if(auth()->id() != $shop->user_id)
      {
        return redirect('/')->with('gagal','Akses ditolak');
      }

      return view('shop.edit',[
      	'data'	=> $shop,
        'kategori'	=> $cats
      ]);
    }


  	public function editSubmit($slug)
    {
      $shop = Shop::where('slug',$slug)->firstOrFail();

      if(auth()->id() != $shop->user_id)
      {
        return redirect('/')->with('gagal','Tidak punya akses');
      }

      request()->validate([
      	'nama'	=> 'required|min:2|max:140',
        'harga'	=> 'required|numeric|max:1000000000',
        'deskripsi' => 'required|min:5',

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

        $shop->gambar = $url_img;
      }

      $slug = str_random(5).'-'.str_slug(request()->nama.'-'.now());

        $shop->nama_barang	= request()->nama;
        $shop->harga		= request()->harga;
        $shop->deskripsi	= request()->deskripsi;
        $shop->cat_id	= request()->kategori;


      if($shop->save())
      {
        return back()->with('sukses','Data telah di ubah');
      }
    }

  	public function laku()
    {
      $shop = Shop::findOrFail(request()->id);

      if($shop->user_id != auth()->id())
      {
        return redirect('/')->with('gagal','Akses di tolak');
      }

      $laku = request()->laku;

      switch($laku)
      {
        case 0:
          $laku = 0;
          break;
        case 1:
          $laku = 1;
          break;
        default:
          $laku = 0;
          break;
      }
      if($shop->update(['laku'=>$laku]))
      {
        return back()->with('sukses-laku-'.request()->id,'Data diubah');
      }
    }

  	public function delete()
    {
      $shop = Shop::findOrfail(request()->id);

      if(auth()->user()->role == 'member')
      {
        if(auth()->id() != $shop->user_id)
        {
          return redirect('/')->with('gagal','Akses ditolak');
        }
      }

      if($shop->delete())
      {
        return redirect('/')->with('sukses','Data shop di hapus');
      }
    }
}