<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Forum;
use App\ForumsDesc;
use App\Quiz;
use App\Gallery;
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

      return view('admin.awal',compact(
        ['users', 'forums', 'quiz', 'gallery',
         'fcom']
      ));
    }

  	public function users()
    {
      return datatables()->of(User::orderBy('created_at','desc'))
        ->addColumn('action', function($user){
          return $user->banned == 1 ?
            '<a href="#" class="btn btn-sm btn-outline-danger">banned</a>' :
          '<a href="#" class="btn btn-sm btn-outline-success">active</a>';
        })
        ->addColumn('pic', function($user){
        	return "<div style='background-image: url(https://graph.facebook.com/$user->provider_id/picture?type=normal)' class='avatar m-1 ml-1 float-left'></div> ";
        })
        ->addColumn('thread', function($user){
        	return "<div>{$user->thread->count()}</div>";
        })
        ->editColumn('name', function($user){
        	return "<div><strong class='mr-2 mb-2 text-center'>$user->name</strong><br><small class='text-muted'>@$user->username</small></div>";
        })
        ->editColumn('created_at',function($user){
        	return $user->created_at->diffForHumans();
        })
        ->rawColumns(['pic','name','action','thread'])
        ->make(true);
    }
}