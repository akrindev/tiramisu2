<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  User, Forum, ForumsDesc, Quiz,
  Gallery, Tag, LogSearch
};

use Datatables;

class AdminController extends Controller
{
  	public function home()
    {
      $users = User::all();
      $forums = Forum::all();
      $fcom = ForumsDesc::all();
      $quiz = Quiz::all();
      $gallery = Gallery::all();
      $tags = Tag::all();

      return view('admin.awal',compact(
        ['users', 'forums', 'quiz', 'gallery',
         'fcom', 'tags']
      ));
    }

  	public function logSearches()
    {
      return datatables()->of(LogSearch::orderBy('created_at', 'desc'))
        ->editColumn('user_id', function ($user) {
        	return $user->user->name ?? 'unknown';
        })
        ->make(true);
    }

  	public function users()
    {
      return datatables()->of(User::orderBy('created_at','desc'))
        ->addColumn('action', function($user){
          return $user->banned == 1 ?
            '<a href="#" data-id="'.$user->id.'" data-p="0" class="btn btn-sm btn-outline-danger change">banned</a>' :
          '<a href="#" data-id="'.$user->id.'" data-p="1" class="btn btn-sm btn-outline-success change">active</a>';
        })
        ->addColumn('pic', function($user){
        	return "<div style='background-image: url(https://graph.facebook.com/$user->provider_id/picture?type=normal)' class='avatar m-1 ml-1 float-left'></div> ";
        })
        ->addColumn('contact', function($user){
        	return "<div>  {$user->contact['line']} <br>  {$user->contact['whatsapp']} </div>";
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

  	public function changeUser()
    {
      $user = User::findOrFail(request()->id);

      $user->banned = request()->p;
      $user->save();

      return response()->json([
        'success'	=>	true,
        'ban'		=> request()->p
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