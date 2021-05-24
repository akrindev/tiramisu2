<?php

namespace App\Http\Controllers;

use App\Drop;
use App\DropType;
use App\Helpers\SaveAsImage as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{

    public function showThem()
    {
        if($name = request()->get('name')) {
            $data = Drop::when(Str::contains($name, ' '), function ($query) use ($name) {
                $words = explode(' ', $name);
                $words = array_unique($words);

                $query->where(function ($query) use ($words) {
                    foreach ($words as $word) {
                        $query->orWhere('name', 'like', '%'. $word .'%')
                            ->orWhere('name_en', 'like', '%'. $word .'%');
                    }
                });
            }, function ($query) use ($name) {
                $query->search('name', $name);
            })
            ->when(\request()->get('did'), function ($query) {
                $query->where('drop_type_id', '=', \request()->get('did'));
            })
            ->orderByDesc('drop_type_id')->paginate();

            $type = "Related Item: $name";

            return view('monster.items', compact('data', 'type'));
        }

        return \redirect()->intended('/items');
    }

    /*
    * Show single item
    */
    public function showItem($id)
    {
        $item = Drop::with([
        'monsters' => function ($query) {
            $query->with([
                // 'map',
                // 'element',
                'drops'
            ]);
        },
        'dropType'
        ])->findOrFail($id);

        if(Str::contains($item->name, ' ') || Str::contains($item->name_en, ' ')) {
            $words = array_merge(explode(' ', $item->name_en), explode(' ', $item->name));
            $words = array_unique($words);
            $dropid = $item->drop_type_id;

            $relateds = Drop::where('id', '!=', $item->id) // bukan data item itu sendiri
            ->whereDropTypeId($dropid)
            ->where(function ($query) use ($words, $dropid) {

                foreach ($words as $word) {
                    $query->orWhere('name', 'like', '%'. $word .'%')
                        ->orWhere('name_en', 'like', '%'. $word .'%');
                }
            })->inRandomOrder()->take(10)->get();

            // jika tidak ada similiar items, yuk tampilin random items dengan type yang sama
            if(!$relateds->count()) {
                $relateds = $this->getRandomRelated($item->drop_type_id, $item->id);
            }
        } else {
            $relateds = $this->getRandomRelated($item->drop_type_id, $item->id);
        }


        return view('monster.item', compact('item', 'relateds'));
    }

    private function getRandomRelated($type, $id)
    {
        return Drop::whereDropTypeId($type)
                            ->where('id', '!=', $id) // bukan data item itu sendiri
                            ->inRandomOrder()
                            ->take(10)
                            ->get();
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
