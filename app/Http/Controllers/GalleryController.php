<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\GalleryComment;
use App\Notifications\GalleryCommented;
use Image;

class GalleryController extends Controller
{
    public function index()
    {
      $galleries = Gallery::latest()->paginate(20);

      return view('gallery.index',[
      	'data'	=> $galleries
      ]);
    }

  	public function single($id)
    {
      $img = Gallery::findOrFail($id);

      $img->increment('views');
      $comments = $img->comment;

      return view('gallery.single',[
      	'pos' => $img,
        'comments' => $comments
      ]);
    }

  	public function upload()
    {
      request()->validate([
        'body'	=> 'min:5|max:140',
      	'gambar'	=> 'required|image|mimes:jpg,png,jpeg,gif|dimensions:min_width=300,min_height=150'
      ],
           [
             'dimensions' => 'Lebar min 300px dan tinggi min 150px'
           ]);

      $body = e(request()->body);

      $body = preg_replace('/#(\w+)/',"<a href='/gallery/tag/\\1'>#\\1</a>",$body);


      if(request()->hasFile('gambar'))
      {
        $gambar = request()->file('gambar');

        $name = substr(md5(now()),0,8).'.png';

        Image::make($gambar->path())
          ->insert(public_path().'/img/up-on.png')
          ->save(public_path().'/uploads/'.$name);

        $Cupload = new CUpload;
        $up = $Cupload->upload(public_path().'/uploads/'.$name);

        unlink(public_path().'/uploads/'.$name);

        $url_img = $up['secure_url'];
      }

      Gallery::create([
        'user_id' => auth()->id(),
      	'body'	=> $body,
        'gambar'	=> $url_img
      ]);

      return back()->with('sukses','Gambar telah di unggah!');
    }

  	public function edit($id)
    {
      $img = Gallery::findOrFail($id);

      if ($img->user_id != auth()->id())
      {
        return redirect('/')->with('gagal','Akses Ditolak');
      }

      return view('gallery.edit',[
      	'data' => $img
      ]);
    }

  	public function editSubmit($id)
    {
      $img = Gallery::findOrFail($id);

      if ($img->user_id != auth()->id())
      {
        return redirect('/')->with('gagal','Akses Ditolak');
      }

      request()->validate([
      	'body'	=> 'required|min:5|max:140'
      ]);

      $img->update([
      	'body'	=> e(request()->body)
      ]);

      return back()->with('sukses','Data telah di ubah!');
    }

  	public function comment($id)
    {
      $gallery = Gallery::findOrFail($id);

      request()->validate([
      	'body'	=> 'required|min:5'
      ]);

      $gallery->comment()->create([
        'user_id'	=> auth()->id(),
      	'body'	=> request()->body
      ]);


    if(auth()->id() != $gallery->user_id)
    {
        $gallery->notify(
          new GalleryCommented(
            'Mengomentari gambar ',
            $gallery,
            $gallery->comment()->latest()->first())
        );
    }
      return back()->with('sukses_comment','Komentar ditambahkan');
    }
  	/**
    *
    * Admin berhak menghapus
    */
  	public function destroy()
    {
      $img = Gallery::findOrFail(request()->id);

      if(auth()->user()->role == 'member' || $img->user_id != auth()->id())
      {
        return redirect('/')->with('gagal','Akses Ditolak');
      }

      if($img->delete())
      {
        return redirect('/gallery')->with('sukses','Gambar di hapus');
      }
    }

  	public function destroyComment()
    {
      $comment = GalleryComment::findOrFail(request()->id);

      if(auth()->user()->role == 'member')
      {
        return redirect('/')->with('gagal','Akses Ditolak');
      }

      if($comment->delete())
      {
        return back()->with('sukses','komentar di hapus');
      }
    }
}