<?php

namespace App\Http\Controllers\Api\v1;

use App\Drop;
use App\DropType;
use App\Http\Controllers\Controller;
use App\Monster;
use Illuminate\Http\Request;

class PubicAPIController extends Controller
{
    public function getItems()
    {
        return Drop::orderByDesc('id')->take(15)->get();
    }

    public function itemsType()
    {
        return DropType::get();
    }

    public function itemsByType($items)
    {
        return Drop::whereRelation('dropType', 'id', $items)->orderByDesc('id')->paginate();
    }

    public function getItem($item)
    {
        return Drop::findOrFail($item);
    }

    public function getMonsters()
    {
        return Monster::orderByDesc('id')->take(15)->get();
    }

    public function getMonster(Monster $monster)
    {
        $monster->load([
            'drops' => function ($query) {
                $query->without('monsters')->take(20);
            },
            'map'
        ]);

        return $monster;
    }

    public function getMonstersByType($type)
    {
        return Monster::with([
            'drops' => function ($query) {
                $query->without('monsters')->take(20);
            },
            'map'
        ])->where('type', $type)->paginate();
    }
}
