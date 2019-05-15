<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dye;
use App\Monster;
use App\MonthlyDye;

class DyeController extends Controller
{
    public function home()
    {
      $dyes = MonthlyDye::with([
        'monster', 'dye'
      ])->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->get()
        ->sortBy('monster.name');

      $dyes->map(function($item) {
      	$item->monster->name = explode('(', $item->monster->name)[0];

        return $item;
      });


      return view('dye.home', compact('dyes'));
    }

  	public function store()
    {
      $monsters = Monster::where('name', 'like', '%(Ultimate)%')->orderBy('name')->get();
      $dyes = Dye::get();

      $monsters->map(function($item) {
      	$item->name = explode('(', $item->name)[0];

        return $item;
      });

      return view('dye.store', compact('monsters', 'dyes'));
    }

  	public function storeDye()
    {
      MonthlyDye::create([
      	'monster_id'	=> request('monster'),
        'dye_id'		=> request('dye'),
        'type'			=> request('type')
      ]);

      return response()->json(['success' => true]);
    }

  	public function delete()
    {
      $dye = MonthlyDye::findOrFail(request('id'));
      $dye->delete();

      return response()->json(['success'=>true]);
    }
}