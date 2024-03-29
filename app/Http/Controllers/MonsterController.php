<?php

namespace App\Http\Controllers;

use App\Drop;
use App\Map;
use App\Monster;
use App\Resep;
use Image;

class MonsterController extends Controller
{
    /**
     * show all map
     *
     * @return void
     */
    public function index()
    {
        $data = Map::orderBy('name')->get();

        return view('monster.index', compact('data'));
    }

    /**
     * show single map
     *
     * @param  int  $id
     * @return void
     */
    public function peta($id)
    {
        $data = Map::with([
            'monster' => function ($query) {
                $query->with([
                    'drops' => function ($q) {
                        $q->with('dropType');
                    },
                    'map',
                    'element',
                ]);
            },
            'npc',
        ])
            ->findOrFail($id);

        return view('monster.single', compact('data'));
    }

    /**
     * create new map
     *
     * @return void
     */
    public function addMap()
    {
        Map::create([
            'name' => request()->name,
            'name_en' => request()->name_en ?? request()->name,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * update map name
     *
     * @return void
     */
    public function editMap()
    {
        if (request()->input() || request()->ajax()) {
            $id = request()->id;

            $map = Map::findOrFail($id);
            $map->name = request()->nama;
            $map->name_en = request()->name_en ?? request()->nama;
            $map->save();

            return response()->json(['success' => true]);
        }

        $peta = Map::orderByDesc('id')->get();

        /*
    * tabler theme
    *
    * return view('monster.edit_map', compact('peta'));
    */

        return view('monster.peta.peta', compact('peta'));
    }

    /**
     * show monster info by id
     *
     * @param  int  $id
     * @return void
     */
    public function showMons($id)
    {
        $data = Monster::with([
            'drops' => function ($query) {
                $query->with('dropType');
            },
            'map',
            'element',
        ])
            ->findOrFail($id);

        $relateds = Monster::whereMapId($data->map_id)
            ->where('id', '!=', $data->id) // bukan data monster itu sendiri
            ->inRandomOrder()
            ->take(10)->get();

        return view('monster.mobs', compact('data', 'relateds'));
    }

    /**
     * show monster by type
     *
     * @param  mixed  $name
     * @return void
     */
    public function showMonsType($name)
    {
        $type = 'list '.$name;

        switch ($name) {
            case 'boss':
                $tipe = 3;
                $type = 'Type Boss';
                break;
            case 'mini_boss':
                $tipe = 2;
                $type = 'Mini Boss';
                break;
            default:
                $tipe = 1;
                $type = 'Monster Normal';
        }

        $data = Monster::with([
            'drops' => function ($query) {
                $query->with('dropType');
            },
            'map',
            'element',
        ])->whereType($tipe)->orderByDesc('id')->paginate(20);

        return view('monster.type', compact('data', 'type'));
    }

    /**
     * showAllMons
     *
     * @return void
     */
    public function showAllMons()
    {
        $type = 'Semua Monster';

        $data = Monster::with([
            'drops' => function ($query) {
                $query->with('dropType');
            },
            'map',
            'element',
        ])->orderByDesc('id')->paginate(20);

        return view('monster.type', compact('data', 'type'));
    }

    /**
     * show all mosnter by element
     *
     * @param  mixed  $type
     * @return void
     */
    public function showMonsEl($type)
    {
        $el = match ($type) {
            'air' => 1,
            'angin' => 2,
            'bumi' => 3,
            'api' => 4,
            'gelap' => 5,
            'cahaya' => 6,
            default => 7
        };

        $data = Monster::with([
            'drops' => function ($query) {
                $query->with('dropType');
            },
            'map',
            'element',
        ])->whereElementId($el)->orderBy('level')->paginate(15);

        $type = __('Unsur').' '.ucfirst($type);

        return view('monster.type', compact('data', 'type'));
    }

    /**
     * editMons
     *
     * @param  int  $id
     * @return void
     */
    public function editMons($id)
    {
        $data = Monster::findOrFail($id);

        return view('monster.edit_mobs', compact('data'));
    }

    /**
     * update monster
     *
     * @param  mixed  $id
     * @return void
     */
    public function editMobPost($id)
    {
        $mons = Monster::findOrFail($id);

        if (request()->hasFile('picture')) {
            $file = request()->file('picture')->getRealPath();

            $nama = 'imgs/mobs/'.str_slug(strtolower(request('nama'))).'-'.rand(00000, 99999).'.png';

            $make = Image::make($file);

            $make->text('toram-id.com', 15, 30, function ($font) {
                $font->file(3);
                $font->size(34);
                $font->color('#ffffff');
                $font->align('left');
                $font->valign('bottom');
            });

            $make->save(public_path($nama));

            $mons->picture = $nama;
        }

        $mons->name = request()->nama;
        $mons->name_en = request()->name_en ?? request()->nama;
        $mons->map_id = request()->map;
        $mons->element_id = request()->element;
        $mons->level = request()->level;
        $mons->type = request()->type;
        $mons->hp = request()->hp;
        $mons->xp = request()->xp;
        $mons->pet = request()->pet ? 'y' : 'n';
        $mons->save();

        $drops = Drop::find(request()->drop);

        $mons->drops()->sync($drops);

        return response()->json(['success' => true]);
    }

    /**
     * delete monster
     *
     * @param  int  $id
     * @return void
     */
    public function monsHapus($id)
    {
        $mons = Monster::findOrFail($id);
        $mons->delete();

        return redirect('/monster')->with('success', 'Data monster telah di hapus');
    }

    /**
     * storeMons
     *
     * @return void
     */
    public function storeMons()
    {
        if (request()->input()) {
            $q = request()->q;
            $drops = Drop::with('dropType')->where('name', 'like', '%'.$q.'%')->orderBy('name')->paginate(15);

            return response()->json($drops);
        }

        return view('monster.sb-admin.add_monster');
    }

    /**
     * create new monster
     *
     * @return void
     */
    public function storeMob()
    {
        $mons = Monster::create([
            'name' => request()->nama,
            'name_en' => request()->name_en ?? request()->nama,
            'map_id' => request()->map,
            'element_id' => request()->element,
            'level' => request()->level,
            'type' => request()->type,
            'hp' => request()->hp,
            'xp' => request()->xp,
            'pet' => request()->pet ? 'y' : 'n',
        ]);

        if (request()->hasFile('picture')) {
            $file = request()->file('picture')->getRealPath();

            $nama = 'imgs/mobs/'.str_slug(strtolower(request('nama'))).'-'.rand(00000, 99999).'.png';

            $make = Image::make($file);

            $make->text('toram-id.com', 15, 30, function ($font) {
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

        return response()->json(['success' => true]);
    }

    public function storeResep()
    {
        if (request()->input()) {
            $resep = Drop::findOrFail(request()->drop);

            $bahan = array_filter(request()->bahan, 'strlen');
            $butuh = array_filter(request()->butuh, 'strlen');

            $resep->resep()->create([
                'material' => implode(',', $bahan),
                'jumlah' => implode(',', $butuh),
                'fee' => request()->fee,
                'level' => request()->level,
                'diff' => request()->diff,
                'set' => request()->set,
                'pot' => request()->pot,
                'base' => request()->base,
            ]);

            return response()->json(['success' => true]);
        }

        return view('monster.add_resep');
    }

    public function hapusResep($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return response()->json(['success' => true]);
    }

    public function fetchI($id)
    {
        $mons = Monster::find($id);
        $data = $mons->drops()->with('dropType')->get();

        return response()->json($data);
    }
}
