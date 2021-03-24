<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Drop;
use App\TempDrop;
use App\DropType;
use App\Helpers\SaveAsImage as Image;

class TempDropController extends Controller
{
    /*
    *   tambahkan item
    */
    public function store(Request $request)
    {

        $item = new TempDrop;
        $item->user_id = \auth()->id() ?? null;

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'picture' => 'image|max:500',
            'fullimage' => 'image|max:500'
        ]);

        // cek apakah terdapat gambar
        if(request()->hasFile('picture'))
        {
          $file = request()->file('picture')->getRealPath();

          $nama = "/temp/".str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

          $save = (new Image)->file($file)->name($nama)->save();

          $item->picture = $nama;
        }

        // cek apakah item punya type gabbar yang lain
        if(request()->hasFile('fullimage'))
        {
          $file = request()->file('fullimage')->getRealPath();

          $fullimage = '/temp/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

          $save = (new Image)->file($file)->name($fullimage)->save();

          $item->fullimage = $fullimage;
        }

        $item->name         = $request->name;
        $item->name_en	    = $request->name_en ?? $request->name;
        $item->drop_type_id = $request->type;

        if(! is_null(request()->noteMonster) || ! is_null(request()->noteNpc)) {
          $item->note = [
            'monster' => $request->noteMonster ?? null,
            'npc'     => $request->noteNpc ?? null,
          ];
        }

        $item->save();

        return response()->json([
            'success'	=>	true,
        ]);
    }

    public function edit($id)
    {
        $item = Drop::findOrFail($id);

        return view('temp.drop.edit', [ 'item' => $item ]);
    }

    public function update(Request $request)
    {
        // pastikan item tersebut sudah ada
        $drop = Drop::findOrFail(request()->id);

        // masukan kedalam temp
        $item = new TempDrop;
        $item->drop_id = $drop->id;

        // apakah user sedang login?
        $item->user_id = \auth()->id() ?? null;

        // validasi request
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'picture' => 'image|max:500',
            'fullimage' => 'image|max:500'
        ]);

        // cek apakah terdapat gambar
        if(request()->hasFile('picture'))
        {
          $file = request()->file('picture')->getRealPath();

          $nama = '/temp/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

          $save = (new Image)->file($file)->name($nama)->save();
        }

        // cek apakah item punya type gambar yang lain
        if(request()->hasFile('fullimage'))
        {
            $file = request()->file('fullimage')->getRealPath();

            $fullimage = '/temp/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

            $save = (new Image)->file($file)->name($fullimage)->save();

        }

        $item->name         = $request->name;
        $item->name_en	    = $request->name_en ?? $request->name;
        $item->drop_type_id = $request->type;

        $item->picture = $nama ?? null;
        $item->fullimage = $fullimage ?? null;

        if(! is_null(request()->noteMonster) || ! is_null(request()->noteNpc)) {
          $item->note = [
            'monster' => $request->noteMonster ?? null,
            'npc'     => $request->noteNpc ?? null,
          ];
        }

        $item->save();

        return response()->json([
            'success'	=>	true,
            'redirect'  => $drop->id
        ]);
    }
}
