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
      'monsters' => function ($query) {
        return $query->with([
          'map',
          'element',
          'drops'
        ]);
      },
      'dropType'
    ])->findOrFail($id);

    $relateds = Drop::whereDropTypeId($item->drop_type_id)
                    ->where('id', '!=', $item->id) // bukan data item itu sendiri
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

    return view('monster.item', compact('item', 'relateds'));
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
    return view('drop.sb-admin.add_drop');
  }

  public function see()
  {
      return view('drop.sb-admin.see');
  }
}
