<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ScammerReplied;
use Image;
use App\Scammer;
use App\ScammerPic;
use App\ScammerComment;
use App\CatScammer;
use Auth;

class ScammerController extends Controller
{
  	public function show()
    {
      $lists = Scammer::latest()->paginate(20);

      return view('scammer.show',[
      	'data'	=> $lists,
        'title'	=> 'Daftar kasus penipuan / scam toram online',
        'description'	=> 'Daftar akun penipu toram online'
      ]);
    }

  	public function read($slug)
    {
      $scam = Scammer::where('slug',$slug)->firstOrFail();

      return view('scammer.read',[
        'data'	=> $scam
      ]);
    }

  	public function kategori($id)
    {
      $cats = CatScammer::findOrFail($id);

      return view('scammer.show', [
      	"data"	=> $cats->scammer()->latest()->paginate(20),
        'title'	=> 'Scam kategori ' . $cats->name,
        'description'	=> 'Kasus penipuan toram online kategori ' . $cats->name
      ]);
    }

  	public function cari()
    {
      $q = request()->q;

      $scam = Scammer::latest()
        		->where('judul', 'like', '%'.$q.'%')
        		->orWhere('facebook', 'like', '%'.$q.'%')
        		->orWhere('line', 'like', '%'.$q.'%')
        		->orWhere('ign', 'like', '%'.$q.'%')
        		->paginate(20);

      return view('scammer.show',[
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

  public function editImg()
  {
    $img = ScammerPic::findOrFail(request()->id);

    if($img->user_id != auth()->id())
    {
      return response()->json(["sukses"=>false]);
    }

    $img->delete();

    return response()->json(["sukses"=>true]);
  }

  public function edit($slug)
  {
    $kat = CatScammer::all();
    $scam = Scammer::where('slug',$slug)->firstOrFail();

    if(auth()->id() != $scam->user_id)
    {
      return redirect('/')->with('gagal','Tidak punya akses ini!');
    }

    return view('scammer.edit', compact('scam','kat'));
  }

    public function editPost($slug)
    {
      $scam = Scammer::where('slug',$slug)->firstOrFail();

      request()->validate([
        'judul' => 'required',
        'kasus' => 'required'
      ]);


        $scam->judul = request()->judul;
        $scam->body = request()->kasus;
        $scam->cat_scammer_id = request()->kategori;
        $scam->facebook = request()->facebook;
        $scam->line = request()->line;
        $scam->ign = request()->ign;
        $scam->spina = request()->spina;

        $scam->save();

      if(request()->hasFile('gambar'))
      {
        $files = request()->file('gambar');

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
      }

      return response()->json(['redirect'=>$slug]);
    }

  public function scammerDelete()
  {
    $scam = Scammer::findOrFail(request()->id);

    if($scam->user_id != auth()->id())
    {
    	return response()->json(["sukses"=>false]);
    }

    $scam->delete();

    return response()->json(["sukses"=>true]);
  }


  public function comment($slug)
  {
    $scam = Scammer::where('slug',$slug)->first();

    if( ! $scam)
    {
      return redirect('/')->with('gagal', 'Thread tidak di temukan');
    }


    request()->validate([
    	'body'	=> 'required|min:5'
    ]);

	$comment = ScammerComment::create([
    	'user_id' => Auth::user()->id,
      	'scammer_id'	=> $scam->id,
      	'body'	=> request('body')
    ]);


    if(auth()->id() != $scam->user_id)
    {
        $scam->notify(
          new ScammerReplied(
            'Menjawab di',
            $scam,
            $scam->comment()->latest()->first())
        );

      	if($scam->user->fcm()->count() > 0)
        {
          fcm()->to([$scam->user->fcm->token])
            ->notification([
            	'title' => 'Post anda mendapat komentar',
              	'body' => explode(' ',auth()->user()->name)[0] . ' Menjawab pada ' . $forum->judul,
              	'icon'	=> 'https://graph.facebook.com/'.auth()->user()->provider_id.'/picture?type=normal',
              	'click_action' => 'https://toram-id.info/scammer/r/'.$scam->slug
            ])
            ->send();
        }
    }

    if($comment)
    {
      return back()->with('sukses_comment', 'Komentar di tambahkan');
    }
  }

  public function commentReply($slug)
  {
    $scam = Scammer::where('slug',$slug)->firstOrFail();

    $id = request('id');

    request()->validate([
    	'reply'	=> 'required'
    ]);

	$comment = $scam->comment()->create([
    	'user_id' => Auth::user()->id,
      	'scammer_id'	=> $scam->id,
      	'parent_id' => $id,
      	'body'	=> request('reply')
    ]);

    $replied = ScammerComment::find($id);

    if(auth()->id() != $replied->user_id)
    {
      $replied->notify(
        new ScammerReplied(
          'Membalas di',
          $scam,
          $scam->comment()->latest()->first())
      );


      	if($replied->user->fcm()->count() > 0)
        {
          fcm()->to([$replied->user->fcm->token])
            ->notification([
            	'title' => 'Komentar anda mendapat balasan',
              	'body' => explode(' ',auth()->user()->name)[0] . ' Membalas pada ' . $scam->judul,
              	'icon'	=> 'https://graph.facebook.com/'.auth()->user()->provider_id.'/picture?type=normal',
              	'click_action' => 'https://toram-id.info/forum/'.$scam->slug
            ])
            ->send();
        }
    }

    if($comment)
    {
      return back()->with('sukses_reply-'.$id, 'balasan di tambahkan');
    }
  }

  public function deleteComment()
  {
    $komen = ScammerComment::findOrFail(request()->cid);

    $komen->delete();

    return response()->json(["success"=>true]);
  }


  public function deleteByAdmin()
  {
    $scam = Scammer::findOrFail(request()->id);

    if(! auth()->user()->isAdmin())
    {
    	return response()->json(["success"=>false]);
    }

    $scam->delete();

    return response()->json(["success"=>true]);
  }

}