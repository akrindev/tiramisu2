<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Map;
use App\Monster;

class MonsterController extends Controller
{
    public function showMap()
    {
        $maps = Map::orderBy('name')->get();

        return response()->json($maps, 200, [], JSON_PRETTY_PRINT);
    }

    public function showByMap($id)
    {
        $mobs = Monster::with([
            'map',
            'element',
            'drops' => function ($query) {
                $query->with('dropType');
            },
        ])
                  ->whereMapId($id)
                  ->get();

        //  dd($mobs);
        $mobs->map(function ($item) {
            $item->drops->map(function ($i) {
                $i->note = (new \Parsedown)->text(e($i->note));
            });

            return $item;
        });

        return response()->json($mobs, 200, [], JSON_PRETTY_PRINT);
    }

    public function showMonsByMap($id)
    {
        $mons = Monster::with([
            'map',
            'element',
        ])
                    ->whereMapId($id)
                      ->orderBy('name')
                      ->get();

        return response()->json($mons, 200, [], JSON_PRETTY_PRINT);
    }
}
