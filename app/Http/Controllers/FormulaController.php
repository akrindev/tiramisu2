<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formula;

class FormulaController extends Controller
{
    /*
    * store formula
    */
    public function store()
    {
        request()->validate([
        	'body' => 'required',
            'note'	=> 'max:40'
        ]);

        Formula::create([
        	'user_id'	=> auth()->id() ?? null,
            'note'		=> request()->note,
            'final_step'=> request()->final,
            'body'		=> request()->body,
            'starting_pot'	=> request()->starting_pot,
            'highest_mats'	=> request()->highest_mats,
            'success_rate'	=> request()->success_rate
        ]);

        return response()->json(['success' => true]);
    }
}