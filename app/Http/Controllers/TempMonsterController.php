<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\SaveAsImage as Image;
use App\TempMonster;
use App\Drop;
use App\Monster;

class TempMonsterController extends Controller
{
    public function store()
    {
        request()->validate([
            'name'  => 'required',
            'type'  => 'required',
            'map'   => 'required',
            'level' => 'required'
        ]);

        $temp = TempMonster::create([
            'user_id'   => \auth()->id() ?? null,
            'name'      => request()->name,
            'name_en'   => request()->name_en ?? request()->name,
            'type'      => request()->type,
            'map_id'    => request()->map,
            'element_id' => request()->element,
            'level'    => request()->level,
            'hp'    => request()->hp,
            'xp'    => request()->xp,
        ]);

        // jika monster punya gambar
        if(request()->hasFile('picture'))
        {
            $file = request()->file('picture')->getRealPath();

            $nama = "/temp/".str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

            $save = (new Image)->file($file)->name($nama)->save();

            $temp->picture = $nama;
            $temp->save();
        }

        $drops = Drop::find(request()->drops);

        $temp->drops()->attach($drops);

        return response()->json([ "success" => true ]);
    }

    public function getList()
    {
        $q = request()->q;
        $drops = Drop::with('dropType')
        ->where('name', 'like' ,'%'.$q.'%')
        ->orderBy('name')
        ->paginate(20);

        return response()->json($drops);
    }


    public function edit($id)
    {
        $monster = Monster::findOrFail($id);

        return view('temp.monster.edit', [ 'monster' => $monster ]);
    }

    public function update()
    {
        request()->validate([
            'name'  => 'required',
            'type'  => 'required',
            'map'   => 'required',
            'level' => 'required'
        ]);

        // cek apakah data monster tersedia
        $monster = Monster::findOrFail(\request()->id);

        $temp = TempMonster::create([
            'user_id'   => \auth()->id() ?? null,
            'monster_id'=> $monster->id,
            'name'      => request()->name,
            'name_en'   => request()->name_en ?? request()->name,
            'type'      => request()->type,
            'map_id'    => request()->map,
            'element_id' => request()->element,
            'level'    => request()->level,
            'hp'    => request()->hp,
            'xp'    => request()->xp,
        ]);

        // jika monster punya gambar
        if(request()->hasFile('picture'))
        {
            $file = request()->file('picture')->getRealPath();

            $nama = "/temp/".str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

            $save = (new Image)->file($file)->name($nama)->save();

            $temp->picture = $nama;
            $temp->save();
        }

        $drops = Drop::find(request()->drops);

        $temp->drops()->attach($drops);

        return response()->json([ "success" => true ]);
    }

    public function fetchItem($id)
    {
        $mons = Monster::findOrFail($id);
        $data = $mons->drops()->with('dropType')->get();

        return response()->json($data);
    }
}
