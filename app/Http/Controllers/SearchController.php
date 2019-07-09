<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Drop, Monster, Map, Forum, LogSearch};

class SearchController extends Controller
{

  public function search()
  {
    $q = request()->q;

    if(strlen($q) < 2)
    {
      return redirect('/')->with('gagal', 'Mencari harus memiliki 2 karakter atau lebih');
    }

    LogSearch::create([
    	'user_id'	=> auth()->id() ?? null,
      	'q'			=> $q
    ]);

    $drops = Drop::with(['monsters' => function($q){
    	return $q->with('map');
    }])
      ->search('name', $q)
      			->orderBy('name')
      			->get();

    $monsters = Monster::search('name', $q)
      			->orderBy('name')
      			->get();

    $maps = Map::search('name', $q)
      			->orderBy('name')
      			->get();

    $forums = Forum::search('judul', $q)
      			->orderBy('judul')
      			->get();

    return view('monster.search',compact('drops', 'monsters', 'maps', 'forums','q'));

  }
}