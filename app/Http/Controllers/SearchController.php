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

    $drops = Drop::query();

    // if type of search == status only
    $drops->when(request()->type == 'status_only', function ($query) use ($q) {
    	return $query->search('note', $q);
    }, function ($query) {
    	return $query->with([
      		'monsters' => function ($query) {
    			return $query->with('map');
      		}
    	]);
    });

    // if type of search == name only or type is empty, none
    $drops->when(request()->type == 'name_only' || ! request()->type, function ($query) use ($q) {
    	return $query->search('name', $q);
    }, function ($query) {
        return $query->with([
      		'monsters' => function ($query) {
    			return $query->with('map');
       		}
    	]);
    });

    $drops = $drops->paginate();

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