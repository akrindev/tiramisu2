<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;
use App\Drop;
use App\DropType;
use App\Map;
use App\Resep;
use Image;

class MonsterController extends Controller
{
  public function index()
  {
    $data = Map::orderBy('name')->get();

    return view('monster.index', compact('data'));
  }

  public function peta($id)
  {
    $data = Map::findOrFail($id);

    return view('monster.single', compact('data'));
  }

  public function editMap()
  {
    if(request()->input() || request()->ajax())
    {
      $id = request()->id;

      $map = Map::findOrFail($id);
      $map->name = request()->nama;
      $map->save();

      return response()->json(["success"=>true]);
    }

    $peta = Map::get();

    return view('monster.edit_map', compact('peta'));
  }

  public function search()
  {
    $q = request()->q;

    if(strlen($q) < 2)
    {
      return redirect('/')->with('gagal', 'Mencari harus memiliki 2 karakter atau lebih');
    }

    $drops = Drop::where('name','like','%'.$q.'%')
      			->orderBy('name')
      			//->remember(60)
      			->get();

    $monsters = Monster::where('name','like','%'.$q.'%')
      			->orderBy('name')
      			//->remember(60)
      			->get();

    return view('monster.search',compact('drops', 'monsters', 'q'));

  }

  public function showMons($id)
  {
    $data = Monster::findOrFail($id);

    return view('monster.mobs', compact('data'));
  }

  public function editMons($id)
  {
    $data = Monster::findOrFail($id);

    return view('monster.edit_mobs', compact('data'));
  }

  public function editMobPost($id)
  {
    $mons = Monster::findOrFail($id);

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
    }


    $mons->name	= request()->nama;
    $mons->map_id	= request()->map;
    $mons->element_id	= request()->element;
    $mons->level	= request()->level;
    $mons->type	= request()->type;
    $mons->hp	= request()->hp;
    $mons->xp	= request()->xp;
    $mons->pet	= request()->pet ? 'y' : 'n';
    $mons->save();

    $drops = Drop::find(request()->drop);

    $mons->drops()->sync($drops);

    return response()->json(["success"=>true]);
  }

  public function monsHapus($id)
  {
    $mons = Monster::findOrFail($id);
    $mons->delete();

    return redirect('/monster')->with('success', 'Data monster telah di hapus');
  }

  public function showItem($id)
  {
    $item = Drop::findOrFail($id);
    $data = $item->monsters()->paginate(20);

    return view('monster.item', compact('item','data'));
  }

  public function editItem($id)
  {
    $data = Drop::findOrFail($id);

    return view('monster.edit_item', compact('data'));
  }


  public function editItemPost($id)
  {
      $item = Drop::findOrFail($id);

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

        $item->picture	= $nama;
      }

      $item->name		= request()->name;
      $item->drop_type_id = request()->type;
      $item->proses	= request()->proses;
      $item->sell		= request()->sell;
      $item->note		= request()->note;
      $item->save();

      return response()->json([
      	'success'	=>	true,
        'redirect'	=> $id
      ]);
  }

  public function hapusItem($id)
  {
    $item = Drop::findOrFail($id);
    $item->delete();

    return redirect('/monster');
  }

  public function showItems($id)
  {
    $type = DropType::findOrFail($id);
    $data = $type->drop;

    return view('monster.items', compact('type', 'data'));
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
      	'xp'	=> request()->xp,
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
      $same = Drop::where('name', request()->name)
        		->get();

      if($same->count() > 0)
      {
        return response()->json([
          'success'	=>	false
        ]);
      }

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

  public function storeResep()
  {
    if(request()->input())
    {
      $resep = Drop::findOrFail(request()->drop);

      $bahan = array_filter(request()->bahan, 'strlen');
      $butuh = array_filter(request()->butuh, 'strlen');


      $resep->resep()->create([
      	'material'	=> implode(',', $bahan),
        'jumlah'	=> implode(',', $butuh),
        'fee'	=> request()->fee,
        'level'	=> request()->level,
        'diff'	=> request()->diff,
        'set'	=> request()->set
      ]);

      return response()->json(["success"=>true]);
    }

    return view('monster.add_resep');
  }

  public function hapusResep($id)
  {
    $resep = Resep::findOrFail($id);
    $resep->delete();

    return response()->json(["success"=>true]);
  }

  public function fetchI($id)
  {
    $mons = Monster::find($id);
    $data = $mons->drops()->with('dropType')->get();

    return response()->json($data);
  }
}