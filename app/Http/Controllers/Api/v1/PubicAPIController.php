<?php

namespace App\Http\Controllers\Api\v1;

use App\Drop;
use App\DropType;
use App\Http\Controllers\Controller;
use App\Monster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PubicAPIController extends Controller
{
    public function getItems()
    {
        return Cache::remember('latest-items', now()->addMinutes(10), function () {
            return Drop::orderByDesc('id')->take(15)->get();
        });
    }

    public function itemsType()
    {
        return Cache::remember('items-type', now()->addMinutes(10), function () {
            return DropType::get();
        });
    }

    public function itemsByType($items)
    {
        return Cache::remember('items-by-type-' . $items, now()->addMinutes(10), function () use ($items) {
            return Drop::whereRelation('dropType', 'id', $items)->orderByDesc('id')->paginate();
        });
    }

    public function getItem($item)
    {
        return Cache::remember('item-' . $item, now()->addMinutes(10), function () use ($item) {
            return Drop::findOrFail($item);
        });
    }

    public function searchItems($query)
    {
        return Cache::remember('item-search-' . $query, now()->addMinutes(10), function () use ($query) {
            return Drop::search('name', $query)->paginate();
        });
    }

    public function getMonsters()
    {
        return Cache::remember('latest-monsters', now()->addMinutes(10), function () {
            return Monster::orderByDesc('id')->take(15)->get();
        });
    }

    public function getMonster($monster)
    {
        return Cache::remember('monster-' . $monster, now()->addMinutes(10), function () use ($monster) {
            $monster = Monster::findOrFail($monster);

            $monster->load([
                'drops' => function ($query) {
                    $query->without('monsters')->take(20);
                },
                'map'
            ]);

            return $monster;
        });
    }

    public function getMonstersByType($type)
    {
        return Cache::remember('monster-by-type' . $type, now()->addMinutes(10), function () use ($type) {
            return Monster::with([
                'drops' => function ($query) {
                    $query->without('monsters')->take(20);
                },
                'map'
            ])->where('type', $type)->paginate();
        });

    }

    public function searchMonsters($query)
    {
        return Cache::remember('monsters-search-' . $query, now()->addMinutes(10), function () use ($query) {
            return Monster::with([
                'drops' => function ($query) {
                    $query->without('monsters')->take(20);
                },
                'map'
            ])->search('name', $query)->paginate();
        });
    }
}
