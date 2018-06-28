<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Forum;
use App\ForumsDesc;

class ForumController extends Controller
{
  public function feed()
  {
    $forums = Forum::orderBy('created_at','desc')
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

    $forum = Forum::create([
    	'user_id' => Auth::user()->id,
      	'judul'	=> request('judul'),
      	'slug' => $slug,
      	'body'	=> request('deskripsi'),
      	'tags'	=> implode(',',request('tags')),
      	'color'	=> request('color') ?? 'yellow'
    ]);

    if($forum)
    {
      return redirect('/')->with('sukses','Thread berhasil dibuat');
    }

  }

  public function baca($slug)
  {
    $baca = Forum::where('slug',$slug)->first();
	$comments = $baca->comment;
    if( ! $baca)
    {
      return redirect('/')->with('gagal', 'Thread tidak di temukan');
    }

    return view('forum.baca',[
    	'data' => $baca,
      	'comments' => $comments
    ]);
  }

  public function comment($slug)
  {
    $forum = Forum::where('slug',$slug)->first();

    if( ! $forum)
    {
      return redirect('/')->with('gagal', 'Thread tidak di temukan');
    }


    request()->validate([
    	'body'	=> 'required'
    ]);

	$comment = ForumsDesc::create([
    	'user_id' => Auth::user()->id,
      	'forum_id'	=> $forum->id,
      	'body'	=> request('body')
    ]);

    if($comment)
    {
      return back()->with('sukses_comment', 'Komentar di tambahkan');
    }
  }

  public function commentReply($slug)
  {
    $forum = Forum::where('slug',$slug)->first();

    $id = request('id');

    if( ! $forum)
    {
      return redirect('/')->with('gagal', 'Thread tidak di temukan');
    }


    request()->validate([
    	'reply'	=> 'required'
    ]);

	$comment = ForumsDesc::create([
    	'user_id' => Auth::user()->id,
      	'forum_id'	=> $forum->id,
      	'parent_id' => $id,
      	'body'	=> request('reply')
    ]);


    if($comment)
    {
      return back()->with('sukses_reply-'.$id, 'balasan di tambahkan');
    }
  }
}