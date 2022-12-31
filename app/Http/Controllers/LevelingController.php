<?php

namespace App\Http\Controllers;

use App\Helpers\Level;

class LevelingController extends Controller
{
    public function show()
    {
        $lvl = (int) request()->input('level', 60);

        $expNeed = (new Level)->expNeed($lvl);

        return view('monster.leveling', compact('lvl', 'expNeed'));
    }
}
