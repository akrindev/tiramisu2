<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forum;

class ForumController extends Controller
{
    public function feed()
    {
      $feeds = Forum::withCount(['user:id,name,provider_id','comment'])
        ->orderByDesc('created_at')
        ->get();

      $data = $feeds->map(function($item,$key){
        $item->judul = str_limit(e($item->judul),65);
      	$item->body = (new \Parsedown)->text(e($item->body));
        $item->created = $item->created_at->diffForHumans();
        $item->user->name = e(explode(' ',$item->user->name)[0]);

        return $item;
      });

      return response()->json($data,200);
    }

  	public function show($id)
    {
      $item = Forum::whereId($id)->with([
        'user:id,name,provider_id',
        'comment' => function ($query){
          $query->with('user:id,name,provider_id');
        }
      ])->first();//dd(collect($read));

      $item->body = (new \Parsedown)->text(e($item->body));
      $item->created = waktu($item->created_at);
      $item->comment->map(function ($i,$k){
        $i->user->name = e($i->user->name);
        $i->body = (new \Parsedown)->text(e($i->body));
        $i->created = waktu($i->created_at);
        return $i;
      });


      return response()->json($item,200)
        ->header('Access-Control-Allow-Origin','*');
    }
}