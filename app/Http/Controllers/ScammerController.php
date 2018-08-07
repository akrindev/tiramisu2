<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Scammer;
use App\ScammerPic;
use App\ScammerComment;
use App\CatScammer;

class ScammerController extends Controller
{
  	public function show()
    {
      $lists = Scammer::all();

      return view('scammer.show',[
      	'data'	=> $lists
      ]);
    }

  	public function read($slug)
    {
      $scam = Scammer::where('slug',$slug)->firstOrFail();

      return view('scammer.read',[
        'data'	=> $scam
      ]);
    }

    public function add()
    {
      $kat = CatScammer::all();

      return view('scammer.add', compact('kat'));
    }

  	public function addPost()
    {
      request()->validate([
        'judul' => 'required',
        'kasus' => 'required'
      ]);

      if(request()->hasFile('gambar'))
      {
        $files = request()->file('gambar');

        $slug = str_slug(request()->judul).'-'.rand(00000000,99999999);

        $scam = new Scammer;
        $scam->judul = request()->judul;
        $scam->body = request()->kasus;
        $scam->cat_scammer_id = request()->kategori;
        $scam->facebook = request()->facebook;
        $scam->line = request()->line;
        $scam->ign = request()->ign;
        $scam->spina = request()->spina;
        $scam->slug = $slug;

        auth()->user()->scammers()->save($scam);

        foreach ($files as $file)
        {
          $name = md5(now()).'.png';

          Image::make($file->path())
            ->insert(public_path().'/img/up-on.png')
            ->save(public_path().'/uploads/'.$name);

          $Cupload = new CUpload;
          $up = $Cupload->upload(public_path().'/uploads/'.$name);

          unlink(public_path().'/uploads/'.$name);

          $url_img = $up['secure_url'];

          $pic = new ScammerPic;
          $pic->url = $url_img;
          $pic->user_id = auth()->id();

          $scam->picture()->save($pic);
        }


        return response()->json(['redirect'=>$slug]);
      }
    }
}