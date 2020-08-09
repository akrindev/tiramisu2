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

    public function getFormula($id)
    {
        $formula = Formula::find($id)->body;

        return response()->json($formula);
    }

    public function loadSaved()
    {
        $formulas = Formula::select('id', 'note', 'created_at')
            ->whereUserId(auth()->id())
            ->latest()
            ->get();

        $formulas->map(function($formula) {
        	$formula->created = $formula->created_at->format('d-M-Y H:i:s');
        });

        return $formulas;
    }
}