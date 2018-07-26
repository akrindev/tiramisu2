<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Forum;
use App\ForumsDesc;
use App\Quiz;
use App\Gallery;
use Datatables;
use Analytics;
use Spatie\Analytics\Period;

class AdminController extends Controller
{
  	public function home()
    {
      $visitor = Analytics::fetchVisitorsAndPageViews(Period::days(7))->take(10);

      $totalVisitor = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

      $mostVisit = Analytics::fetchMostVisitedPages(Period::days(7));

      $topRef = Analytics::fetchTopReferrers(Period::days(7));

      $topBrowsers = Analytics::fetchTopBrowsers(Period::days(7));

 //   dd($topBrowsers);

      $users = User::all();
      $forums = Forum::all();
      $fcom = ForumsDesc::all();
      $quiz = Quiz::all();
      $gallery = Gallery::all();

      return view('admin.awal',compact(
        ['users', 'forums', 'quiz', 'gallery',
         'fcom', 'visitor', 'totalVisitor', 'mostVisit',
         'topRef', 'topBrowsers']
      ));
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
}