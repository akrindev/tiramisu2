<?php

namespace App\Http\Controllers\Api;

use App\Fill_stat as Fill;
use App\Http\Controllers\Controller;

class FillController extends Controller
{
    /**
     * show
     *
     * @param  mixed  $type
     * @param  mixed  $plus
     * @return void
     */
    public function show($type, $plus)
    {
        $fills = Fill::whereType($type)
            ->wherePlus($plus)
            ->get();

        $data = $fills->map(function ($item, $i) {
            $item->type = $item->type == 1 ? 'Armor' : 'Weapon';
            $item->stats = e($item->stats);
            $item->steps = nl2br((new \Parsedown)->text(e($item->steps)));

            return $item;
        });

        return response()->json($data);
    }
}
