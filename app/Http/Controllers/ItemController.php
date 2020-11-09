<?php

namespace App\Http\Controllers;

use App\Drop;
use App\DropType;
use App\Helpers\SaveAsImage as Image;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  /*
  * Show single item
  */
  public function showItem($id)
  {
    $item = Drop::with([
    	'monsters'	=>	function($query) {
            $query->with([
                'drops' => function($q) {
                    $q->with('dropType');
                },
                'map',
                'element'
            ])->paginate(20);
        },
        'dropType'
    ])->findOrFail($id);

    return view('monster.item', compact('item'));
  }

  /*
  * view edit item
  */
  public function editItem($id)
  {
    $data = Drop::findOrFail($id);

    return view('monster.edit_item', compact('data'));
  }

  /*
  * put and update it
  */
  public function editItemPost($id)
  {
      $item = Drop::findOrFail($id);

      if(request()->hasFile('picture'))
      {
        $file = request()->file('picture')->getRealPath();

        $nama = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $save = (new Image)->file($file)->name($nama)->save();

        $item->picture = $nama;
      }

      if(request()->hasFile('fullimage'))
      {
        $file = request()->file('fullimage')->getRealPath();

        $fullimage = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $save = (new Image)->file($file)->name($fullimage)->save();

        $item->fullimage = $fullimage;
      }

      $item->name		= request()->name;
      $item->name_en	= request('name_en') ?? request('name');
      $item->drop_type_id = request()->type;
      $item->proses	= request()->proses;
      $item->sell		= request()->sell;

      if(! is_null(request()->noteMonster) || ! is_null(request()->noteNpc)) {
        $item->note = [
          'monster' => request()->noteMonster ?? null,
          'npc'     => request()->noteNpc ?? null,
        ];
      }

      $item->save();

      return response()->json([
      	'success'	=>	true,
        'redirect'	=> $id
      ]);
  }

  /*
  * delete item
  */
  public function hapusItem($id)
  {
    $item = Drop::findOrFail($id);
    $item->delete();

    return redirect('/')->with('sukses', 'Item drop berhasil di hapus!');
  }

  /*
  * Show all items from given type
  */
  public function showItems($id)
  {
    $data = Drop::whereDropTypeId($id)->with([
    	'monsters' => function ($query) {
            $query->with('map');
        },
        'dropType',
        'resep'
    ])->orderByDesc('id')->paginate(15);

    if(!$data->count()) {
      return abort(404);
    }

   $type = $data[0]->dropType->name;

    return view('monster.items', compact('data', 'type'));
  }

  /*
  * Show all of items
  */
  public function showAllItems()
  {
    $type = 'Semua Items';

    $data = Drop::with([
            'monsters' => function($q){
                $q->with('map');
            },
            'dropType',
            'resep'
        ])->orderByDesc('id')->paginate(15);

    return view('monster.items', compact('type', 'data'));
  }

  /*
  * Create item
  */

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

        $save = (new Image)->file($file)->name($nama)->save();
      }

      if(request()->hasFile('fullimage'))
      {
        $file = request()->file('fullimage')->getRealPath();

        $fullimage = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $save = (new Image)->file($file)->name($fullimage)->save();
      }

      $note = null;

      if(! is_null(request()->noteMonster) || ! is_null(request()->noteNpc)) {
        $note = [
          'monster' => request()->noteMonster ?? null,
          'npc'     => request()->noteNpc ?? null,
        ];
      }

      $dropType->drop()->create([
      	'name'		=> request()->name,
        'name_en'	=> request()->name_en ?? request()->name,
        'proses'	=> request()->proses,
        'sell'		=> request()->sell,
        'note'		=> $note,
        'picture'	=> $nama ?? null,
        'fullimage'	=> $fullimage ?? null
      ]);

      return response()->json([
      	'success'	=>	true
      ]);
    }

    return view('drop.sb-admin.add_drop');
  }
}