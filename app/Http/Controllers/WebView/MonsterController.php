<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Monster;
use App\Drop;
use App\DropType;
use App\Map;
use App\Resep;
use App\LogSearch;
use Image;

class MonsterController extends Controller
{
  public function index()
  {
    $data = Map::orderBy('name')->get();

    return view('webview.monster.index', compact('data'));
  }

  public function peta($id)
  {
    $data = Map::findOrFail($id);

    return view('webview.monster.single', compact('data'));
  }

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

    $drops = Drop::where('name','like','%'.$q.'%')
      			->orderBy('name')
      			->get();

    $monsters = Monster::where('name','like','%'.$q.'%')
      			->orderBy('name')
      			->get();

    $maps = Map::where('name', 'like', '%'.$q.'%')
      			->orderBy('name')
      			->get();

    return view('webview.monster.search',compact('drops', 'monsters', 'maps','q'));

  }

  public function leveling()
  {
    $lvl = (int) request()->input('level', 50);
    $min = $lvl-3;
    $max = $lvl+3;

    $data = Monster::whereIn('type',[2,3])
        			->whereBetween('level', [$min,$max])
        			->orderBy('level')
        			->get();


    return view('webview.monster.leveling', compact('lvl','data'));
  }

  public function showMons($id)
  {
    $data = Monster::findOrFail($id);

    return view('webview.monster.mobs', compact('data'));
  }

  public function showMonsType($name)
  {
    $type = $name;

    switch($type)
    {
      case 'boss':
        $tipe = 3;
        break;
      case 'mini_boss':
        $tipe = 2;
        break;
      default:
        $tipe = 1;
    }

    $data = Monster::whereType($tipe)
      			->orderBy('name')
      			->paginate(20);

    return view('webview.monster.type', compact('data','type'));
  }

  public function showMonsEl($type)
  {
    switch($type)
    {
      case 'air':
        $el = 1;
        break;
      case 'angin':
        $el = 2;
        break;
      case 'bumi':
        $el = 3;
        break;
      case 'api':
        $el = 4;
        break;
      case 'gelap':
        $el = 5;
        break;
      case 'cahaya':
        $el = 6;
        break;
      default:
        $el = 7;
    }

    $data = Monster::whereElementId($el)
      				->orderBy('level')
      				->paginate(20);

    return view('webview.monster.type',compact('data','type'));
  }

  public function showItem($id)
  {
    $item = Drop::findOrFail($id);
    $data = $item->monsters()->paginate(20);

    return view('webview.monster.item', compact('item','data'));
  }

  public function showItems($id)
  {
    $type = DropType::findOrFail($id);
    $data = $type->drop()->orderByDesc('id')->paginate(15);

    return view('webview.monster.items', compact('type', 'data'));
  }
}