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
        $page = '?page=' . request()->has('page') ? request()->page : 1;

        return Cache::remember('items-by-type-' . $items . $page, now()->addMinutes(10), function () use ($items) {
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
        $page = '?page=' . request()->has('page') ? request()->page : 1;

        return Cache::remember('item-search-' . $query . $page, now()->addMinutes(10), function () use ($query) {
            return Drop::search('name', $query)->paginate();
        });
    }

    public function getMonsters()
    {
        $level = '?level=' . request()->has('level') ? intval(request()->level) : '';
        $between = '&between=' . request()->has('between') ? intval(request()->between) : '';

        return Cache::remember('latest-monsters' . $level . $between, now()->addMinutes(10), function () {
            return Monster::with('map')->when(request()->has('level'), function ($query) {
                return $query->when(request()->has('between'), function ($query) {

                    $between = intval(request()->between);
                    $level = intval(request()->level);

                    return $query->whereBetween('level', [$level-$between, $level+$between]);
                }, function ($query) {
                    return $query->where('level', intval(request()->level));
                });
            })->orderByDesc('id')->take(15)->get();
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
        $page = '?page=' . request()->has('page') ? request()->page : 1;
        $level = '&level=' . request()->has('level') ? intval(request()->level) : '';
        $between = '&between=' . request()->has('between') ? intval(request()->between) : '';

        return Cache::remember('monster-by-type' . $type . $page. $level . $between, now()->addMinutes(10), function () use ($type) {
            return Monster::with([
                'drops' => function ($query) {
                    $query->without('monsters')->take(20);
                },
                'map'
            ])
            ->where('type', $type)
            ->when(request()->has('level'), function ($query) {
                $query->when(request()->has('between'), function ($query) {

                    $between = intval(request()->between);
                    $level = intval(request()->level);

                    return $query->whereBetween('level', [$level-$between, $level+$between]);
                }, function ($query) {
                    return $query->where('level', intval(request()->level));
                });
            })->paginate();
        });

    }

    public function searchMonsters($query)
    {
        $page = '?page=' . request()->has('page') ? request()->page : 1;

        return Cache::remember('monsters-search-' . $query . $page, now()->addMinutes(10), function () use ($query) {
            return Monster::with([
                'drops' => function ($query) {
                    $query->without('monsters')->take(20);
                },
                'map'
            ])->search('name', $query)->paginate();
        });
    }
}
