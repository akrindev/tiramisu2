<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  User, Forum, Quiz,
  Gallery, LogSearch, HistoryLogin,
  Drop, Monster, Formula
};


class AdminController extends Controller
{
  	public function home()
    {
      $users = User::count();
      $searches = LogSearch::count();
      $images = Gallery::count();
      $items = Drop::count();
      $monsters = Monster::count();
      $quizzes = Quiz::count();
      $forums = Forum::count();
      $formulas = Formula::count();

      /*
      * Tabler theme
      * return view('admin.awal',compact(
      *  ['users', 'forums', 'quiz', 'gallery',
      *   'fcom', 'tags']
      *));
      */

      return view('admin.sb-admin.content', compact('users', 'searches', 'images', 'items', 'monsters', 'quizzes', 'forums', 'formulas'));
    }

  	/*
    * last forum thread
    */
  	public function lastThread()
    {
      return datatables(Forum::latest())
        	->editColumn('judul', function ($title) {
            	return "<a href='/forum/{$title->slug}'>{$title->judul}</a><br /> Views: <span class='badge badge-success'>{$title->views}</span> komentar: <span class='badge badge-danger'>{$title->comment->count()}</span>";
            })
        	->editColumn('user_id', function ($user) {
        		return $user->user->name ?? 'unknown';
        })
        	->rawColumns(['judul'])

        ->editColumn('created_at',function($user){
        	return waktu($user->created_at);
        })
        	->make(true);
    }

  	public function users()
    {
      return datatables()->of(User::orderBy('created_at','desc'))
        ->addColumn('action', function($user){
          return $user->banned == 1 ?
            '<a href="#" data-id="'.$user->id.'" class="btn btn-sm btn-outline-danger change">banned</a>' :
          '<a href="#" data-id="'.$user->id.'" class="btn btn-sm btn-outline-success change">active</a>';
        })
        ->addColumn('pic', function($user){
        	return "<div><div style='width:2rem;height:2rem;border-radius:50%;display:inline-block;background-image: url({$user->getAvatar()})' class='avatar m-1 ml-1 float-left'></div></div> ";
        })
        ->addColumn('contact', function($user){
        	return "<div>  " . optional($user->contact)['line'] .
              "<br>  " . optional($user->contact)['whatsapp'] . " </div>";
        })
        ->editColumn('name', function($user){
        	return "<div><strong class='mr-2 mb-2 text-center'>$user->name</strong><br><small class='text-muted'>@$user->username</small></div>";
        })
        ->editColumn('created_at',function($user){
        	return $user->created_at->diffForHumans();
        })
        ->rawColumns(['pic','name','action','contact'])
        ->make(true);
    }

  	public function lastLogin()
    {
      return datatables()->of(HistoryLogin::orderByDesc('created_at'))
        ->addColumn('pic', function($history){
        	return "<div><div style='width:2rem;height:2rem;border-radius:50%;display:inline-block;background-image: url({$history->user->getAvatar()})' class='avatar m-1 ml-1 float-left'></div></div> ";
        })
        ->editColumn('name', function($history){
        	return "<div><strong class='mr-2 mb-2 text-center'>{$history->user->name}</strong><br><small class='text-muted'>@{$history->user->username}</small></div>";
        })
        ->editColumn('browser', function ($history) {
        	return "<div><small> {$history->browser} </small></div>";
        })
        ->editColumn('created_at',function($history){
        	return $history->created_at->diffForHumans();
        })
        ->rawColumns(['pic', 'name', 'browser'])
        ->make(true);
    }

  	public function changeUser()
    {
      $user = User::findOrFail(request()->id);

      $user->banned = $user->banned == 0 ? 1 : 0;
      $user->save();

      return response()->json([
        'success'	=>	true,
        'ban'		=> $user->banned
      ]);
    }

  	/**
    * Adding tag forum
    */
  	public function tagForum()
    {
      $tag = new Tag;
      $tag->name = request()->tag;
      $tag->save();

      return response()->json(['success'=>true]);
    }

  	public function fetchTag($i)
    {
      $tag = Tag::find($i);

      return response()->json(['tag'=>$tag->name,'id'=>$tag->id]);
    }

    public function editTag()
    {
      $tag = Tag::find(request()->id);
      $tag->name = request()->tag;
      $tag->save();

      return response()->json(['success'=>true]);
    }

  	public function tagHapus()
    {
      $tag = Tag::find(request()->id);
      $tag->delete();

      return response()->json(['success'=>true]);
    }

  	/**
    * scamer kategori
    */

  	public function addKategoriScam()
    {
      $tag = new \App\CatScammer;
      $tag->name = request()->kategori;
      $tag->save();

      return response()->json(['success'=>true]);
    }


  	public function fetchScam($i)
    {
      $tag = \App\CatScammer::find($i);

      return response()->json(['kat'=>$tag->name,'id'=>$tag->id]);
    }

  	public function editScam()
    {
      $tag = \App\CatScammer::find(request()->id);
      $tag->name = request()->kat;
      $tag->save();

      return response()->json(['success'=>true]);
    }


  	public function hapusScam()
    {
      $tag = \App\CatScammer::find(request()->id);
      $tag->delete();

      return response()->json(['success'=>true]);
    }
}