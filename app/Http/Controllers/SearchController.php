<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Drop, Monster, Map, Forum, LogSearch, Setting};

class SearchController extends Controller
{

  public function search()
  {
    $q = request()->q;
    $q = preg_replace('/\/$/', '$1', $q);

    $badword = Setting::first();
    $badword = explode(',', $badword->body['badword']);

    if(strlen($q) < 2)
    {
      return redirect('/')->with('gagal', 'Mencari harus memiliki 2 karakter atau lebih');
    }

    if(in_array($q, $badword)) {
      return redirect('/')->with('gagal', 'Memblokir kata tak pantas');
    }

    LogSearch::create([
    	'user_id'	=> auth()->id() ?? null,
      	'q'			=> $q
    ]);

    $drops = Drop::query();

    // if type of search == status only
    $drops->when(request()->type == 'status_only', function ($query) use ($q) {
        $query->search('note', $q);
    }, function ($query) {
        $query->with([
      		'monsters' => function ($query) {
    		    $query->with(['map', 'element']);
              },
              'dropType'
    	]);
    });

    // if type of search == name only or type is empty, none
    $drops->when(request()->type == 'name_only' || ! request()->type, function ($query) use ($q) {
        $query->search('name', $q);
    }, function ($query) {
        $query->with([
      		'monsters' => function ($query) {
    		    $query->with('map');
               },
               'dropType'
    	]);
    });

    $drops = $drops->orderBy('drop_type_id')->paginate(30);

    $monsters = Monster::with([
        'drops'=> function($query) {
            $query->with('dropType');
        },
        'map',
        'element'
    ])->search('name', $q)->orderBy('name')->get();

    $maps = Map::search('name', $q)
      			->orderBy('name')
      			->get();

    $forums = Forum::search('judul', $q)
      			->orderBy('judul')
      			->get();

    return view('monster.search',compact('drops', 'monsters', 'maps', 'forums','q'));

  }
}
