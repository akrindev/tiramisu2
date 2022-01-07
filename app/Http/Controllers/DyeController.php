<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App;
use App\Dye;
use App\Monster;
use App\MonthlyDye;

/**
 * DyeController
 */
class DyeController extends Controller
{
    /**
     * home
     *
     * @return void
     */
    public function home()
    {
        return view('dye.home');
    }

    /**
     * store new dye list
     *
     * @return void
     */
    public function store()
    {
        $monsters = Monster::whereType(3)
            ->where(function ($query) {
                $diffs = ['(Easy)', '(Normal)', '(Hard)', '(Nightmare)'];

                foreach ($diffs as $diff) {
                    $query->where('name', 'NOT LIKE', "%{$diff}%");
                }
            })
            ->orderBy('name')->get();
        $dyes = Dye::get();

        $monsters
            ->map(function ($item) {

                $item->name = Str::contains($item->name, '(Ultimate)') ? explode('(', $item->name)[0] : $item->name;

                return $item;
            });

        return view('dye.store', compact('monsters', 'dyes'));
    }

    /**
     * create new dye list
     *
     * @return void
     */
    public function storeDye()
    {
        MonthlyDye::create([
            'monster_id'    => request('monster'),
            'dye_id'        => request('dye'),
            'type'            => request('type')
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * delete single dye
     *
     * @return void
     */
    public function delete()
    {
        $dye = MonthlyDye::findOrFail(request('id'));
        $dye->delete();

        return response()->json(['success' => true]);
    }
}
