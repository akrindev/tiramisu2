<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;
use App\Drop;
use App\DropType;
use App\Map;
use Image;

class MonsterController extends Controller
{
  public function index()
  {
    $data = Map::get();

    return view('monster.index', compact('data'));
  }

  public function peta($id)
  {
    $data = Map::findOrFail($id);

    return view('monster.single', compact('data'));
  }

  public function showMons($id)
  {
    $data = Monster::findOrFail($id);

    return view('monster.mobs', compact('data'));
  }

  public function showItem($id)
  {
    $item = Drop::find($id);
    $data = $item->monsters()->paginate(20);

    return view('monster.item', compact('item','data'));
  }

  public function storeMons()
  {
    if(request()->input())
    {
      $q = request()->q;
      $drops = Drop::with('dropType')->where('name', 'like' ,'%'.$q.'%')->paginate(10);

      return response()->json($drops);
    }

  	return view('monster.add_mobs');
  }

  public function storeMob()
  {
    $mons = Monster::create([
    	'name'	=> request()->nama,
      	'map_id'	=> request()->map,
      	'element_id'	=> request()->element,
      	'level'	=> request()->level,
      	'type'	=> request()->type,
      	'hp'	=> request()->hp,
      	'pet'	=> request()->pet ? 'y' : 'n'
    ]);

    if(request()->hasFile('picture'))
    {
      $file = request()->file('picture')->getRealPath();

      $nama = 'imgs/mobs/'.str_slug(strtolower(request('nama'))).'-'.rand(00000,99999).'.png';

      $make = Image::make($file);

      $make->text('(c) toram-id.info',15,30, function($font)
          {
              $font->file(3);
              $font->size(34);
              $font->color('#ffffff');
              $font->align('left');
              $font->valign('bottom');
          });

      $make->save(public_path($nama));

      $mons->picture = $nama;
      $mons->save();
    }

    $drops = Drop::find(request()->drop);

    $mons->drops()->attach($drops);

    return response()->json(["success"=>true]);
  }

  public function storeDrop()
  {
    if(request()->input())
    {
      $type = request()->type;
      $dropType = DropType::find($type);

      if(request()->hasFile('picture'))
      {
        $file = request()->file('picture')->getRealPath();

        $nama = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $make = Image::make($file);

        $make->text('(c) toram-id.info',15,30, function($font)
            {
                $font->file(3);
                $font->size(34);
                $font->color('#ffffff');
                $font->align('left');
                $font->valign('bottom');
            });

        $make->save(public_path($nama));
      }

      $dropType->drop()->create([
      	'name'		=> request()->name,
        'proses'	=> request()->proses,
        'sell'		=> request()->sell,
        'note'		=> request()->note,
        'picture'	=> $nama ?? null
      ]);



      return response()->json([
      	'success'	=>	true
      ]);
    }

    return view('monster.add_drop');
  }
}