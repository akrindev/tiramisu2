<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ThreadReplied;
use Auth;
use App\Forum;
use App\ForumsDesc;
use Cookie;
use Image;

class ForumController extends Controller
{
  public function feed()
  {
    $forums = Forum::orderByDesc('pinned')
      ->latest()
      ->paginate(20);

    return view('forum.feed')->with('data',$forums);
  }

  public function buat()
  {
    return view('forum.buat');
  }

  public function buatSubmit()
  {
    request()->validate([
    	'judul' => 'required|min:5',
      	'deskripsi'	=> 'required|min:20',
    ]);

    $slug = substr(str_slug(request('judul')),0,20) . '-' . substr(sha1(now()),0,8);

    $tags = request('tags');

    $i = 0;

    foreach ($tags as $tag)
    {
      $secondTags[] = $tag;
      $i++;
      if($i == 4) break;
    }

    $forum = Forum::create([
    	'user_id' => Auth::user()->id,
      	'judul'	=> request('judul'),
      	'slug' => $slug,
      	'body'	=> request('deskripsi'),
      	'tags'	=> implode(',',$secondTags),
      	'color'	=> request('color') ?? 'yellow'
    ]);

    if($forum)
    {
      return redirect('/forum/'.$slug)->with('sukses','Thread berhasil dibuat');
    }

  }

  public function baca($slug)
  {
    $baca = Forum::where('slug',$slug)->firstOrFail();

    $comments = $baca->comment;

    $baca->increment('views');


    return view('forum.baca',[
    	'data' => $baca,
      	'comments' => $comments
    ]);
  }

  public function bacaId($id)
  {
    $baca = Forum::findOrFail($id);

    return redirect('/forum/'. $baca->slug);
  }

  public function comment($slug)
  {
    $forum = Forum::where('slug',$slug)->firstOrFail();

    request()->validate([
    	'body'	=> 'required'
    ]);

	$comment = ForumsDesc::create([
    	'user_id' => Auth::user()->id,
      	'forum_id'	=> $forum->id,
      	'body'	=> request('body')
    ]);


    if(auth()->id() != $forum->user_id)
    {
        $forum->notify(
          new ThreadReplied(
            'Menjawab di',
            $forum,
            $forum->comment()->latest()->first())
        );

      	if($forum->user->fcm()->count() > 0)
        {
          fcm()->to([$forum->user->fcm->token])
            ->notification([
            	'title' => 'Forum anda mendapat komentar',
              	'body' => explode(' ',auth()->user()->name)[0] . ' Menjawab pada ' . $forum->judul,
              	'icon'	=> 'https://graph.facebook.com/'.auth()->user()->provider_id.'/picture?type=normal',
              	'click_action' => 'https://toram-id.info/forum/'.$forum->slug
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
    $forum = Forum::where('slug',$slug)->firstOrFail();

    $id = request('id');

    request()->validate([
    	'reply'	=> 'required'
    ]);

	$comment = $forum->comment()->create([
    	'user_id' => Auth::user()->id,
      	'forum_id'	=> $forum->id,
      	'parent_id' => $id,
      	'body'	=> request('reply')
    ]);

    $replied = ForumsDesc::find($id);

    if(auth()->id() != $replied->user_id)
    {
      $replied->notify(
        new ThreadReplied(
          'Membalas di',
          $forum,
          $forum->comment()->latest()->first())
      );


      	if($replied->user->fcm()->count() > 0)
        {
          fcm()->to([$replied->user->fcm->token])
            ->notification([
            	'title' => 'Komentar anda mendapat balasan',
              	'body' => explode(' ',auth()->user()->name)[0] . ' Membalas pada ' . $forum->judul,
              	'icon'	=> 'https://graph.facebook.com/'.auth()->user()->provider_id.'/picture?type=normal',
              	'click_action' => 'https://toram-id.info/forum/'.$forum->slug
            ])
            ->send();
        }
    }

    if($comment)
    {
      return back()->with('sukses_reply-'.$id, 'balasan di tambahkan');
    }
  }

  /**
  *
  * edit thread
  */

  public function edit($slug)
  {
    $thread = Forum::where('slug',$slug)->firstOrFail();

    if(Auth::user()->id != $thread->user_id)
    {
      return redirect('/')->with('gagal','Tidak punya hak akses ini!!');
    }


    return view('forum.edit',['data' => $thread]);
  }

  public function editSubmit($slug)
  {
    $thread = Forum::where('slug',$slug)->firstOrFail();

    if(Auth::user()->id != $thread->user_id)
    {
      return redirect('/')->with('gagal','Tidak punya hak akses ini!!');
    }

    request()->validate([
    	'judul' => 'required|min:5',
      	'deskripsi'	=> 'required|min:20',
    ]);


    $tags = request('tags');

    $i = 0;

    foreach ($tags as $tag)
    {
      $secondTags[] = $tag;
      $i++;
      if($i == 4) break;
    }

    if($thread->update([
      	'judul'	=> request('judul'),
      	'body'	=> request('deskripsi'),
      	'tags'	=> implode(',',$secondTags),
      	'color'	=> request('color') ?? 'yellow'
    ]))
    {
      return redirect('/forum/'.$thread->slug)->with('sukses', 'Thread Updated!!');
    }
  }

  /**
  *
  * Show by tag
  */
  public function byTag($nya)
  {
    $forum = Forum::where('tags','like','%'. $nya .'%')
      ->paginate(20);


    return view('forum.feed',[
    	'data' => $forum
    ]);
  }

  /**
  *
  * cari berdasarkan judul forum
  */
  public function cari()
  {
    $key = request('key');
    $forum = Forum::where('judul','like','%'.$key.'%')->latest()->paginate(20);

    return view('forum.feed',[
    	'data'	=>	$forum
    ]);
  }
  /**
  *
  * pin the thread
  * hanya admin yang bisa melakukan pin thread
  */

  public function pinned($slug)
  {
    $forum = Forum::where('slug',$slug)->firstOrFail();

    if(Auth::user()->role != 'admin')
    {
      return redirect('/')->with('gagal','Kamu tidak punya hak akses ini!');
    }

    if(request('pinthis') == 1)
    {
      $update = [ 'pinned' => 1 ];
      $message = 'Thread has been PINNED!';
    } else {
      $update = [ 'pinned' => 0 ];
      $message = 'Thread has been UNPINNED!';
    }

    if($forum->update($update))
    {
      return back()->with('sukses', $message);
    }
  }

  /**
  *
  * Delete thread
  */
  public function delete($slug)
  {
    $forum = Forum::where('slug',$slug)->firstOrFail();

    if(Auth::user()->role != 'admin')
    {
      return redirect('/')->with('gagal','Kamu tidak punya hak akses ini!');
    }

    if($forum->delete())
    {
      return redirect('/')->with('sukses', 'Thread di hapus');
    }
  }

  // delete by user
  public function deleteByUser($slug)
  {
    $forum = Forum::where('slug',$slug)->firstOrFail();

    if(Auth::id() == $forum->user_id)
    {
      if($forum->delete())
      {
        return redirect('/')->with('sukses', 'Thread di hapus');
      }
    }
    else
    {
      return redirect('/')->with('gagal','Kamu tidak punya hak akses ini!');
    }
  }

  /**
  *
  * delete komentar
  */

  public function deleteComment()
  {
    $forum = ForumsDesc::findOrFail(request('cid'));

    if(Auth::user()->role != 'admin')
    {
      return redirect('/')->with('gagal','Kamu tidak punya hak akses ini!');
    }

    if($forum->delete())
    {
      return back()->with('sukses', 'komentar di hapus');
    }
  }

  public function uploader()
  {
  //  return response()->json(request()->file('gambar'));
      if(request()->hasFile('gambar'))
      {
        $gambar = request()->file('gambar')->getRealPath();

        $name = substr(md5(now()),0,8).'.png';

        $img = Image::make($gambar);
        $img->text('toram-id.info',15,30, function($font) {
          $font->file(3);
          $font->size(34);
          $font->color('#ffffff');
          $font->align('left');
        });
        $img->save(public_path().'/uploads/'.$name);

        $up = app('cloudinary')->uploadImg(public_path().'/uploads/'.$name);

        unlink(public_path().'/uploads/'.$name);

        $url_img = $up['secure_url'];

        return response()->json([
        	'url'	=> $url_img,
          	'token'	=> csrf_token()
        ]);
      }

    return false;
  }


  	/**
    * forum like
    */
  public function postLike()
  {
	$thread = Forum::findOrFail(request()->id);

    if(auth()->user()->hasLikedThread($thread) || !auth()->check())
    {
    	return response()->json(["sukses"=>false]);
    }

    $like = $thread->likes()->create([
    	'user_id'	=> auth()->id()
    ]);

    return response()->json(["sukses"=>true]);
  }

  public function postLikeReply()
  {
    $reply = ForumsDesc::findOrFail(request()->id);

    if(auth()->user()->hasLikedThreadReply($reply) || !auth()->check())
    {
    	return response()->json(["sukses"=>false]);
    }

    $like = $reply->likes()->create([
    	'user_id'	=> auth()->id()
    ]);

    return response()->json(["sukses"=>true]);
  }
}