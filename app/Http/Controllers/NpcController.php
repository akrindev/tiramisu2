<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  Npc, NpcQuest, NpcTujuan, NpcReward, Monster, Drop
};
use Image;

class NpcController extends Controller
{
  public function store()
  {
    if(request()->input() && request()->isMethod('post'))
    {
      $npc = Npc::create([
      	'name'	=> request()->name,
        'map_id'	=> request()->map,
      ]);


      if(request()->hasFile('picture'))
      {
        $file = request()->file('picture')->getRealPath();

        $nama = '/imgs/npc/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $make = Image::make($file);

        $make->text('(c) toram-id.info',15,30, function($font) {
        	$font->file(3);
            $font->size(34);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('bottom');
        });

        $make->save(public_path($nama));

        $npc->picture = $nama;
        $npc->save();
      }

      return response()->json(['success' => true]);
    }

    return view('npc.store');
  }

  public function storeQuest()
  {
    if(request()->q)
    {
      $mons = Monster::where('name', 'like', '%' . request()->q . '%')->select(['id', 'name'])->take(10)->get();

      return response()->json($mons);
    }

    if(request()->d)
    {
      $drops = Drop::where('name', 'like', '%' . request()->d . '%')->with('dropType')->take(10)->get();

      return response()->json($drops);
    }

    if(request()->isMethod('post'))
    {
      $quest = NpcQuest::create([
      	'name'	=> request()->name,
        'npc_id'=> request()->npc,
        'level'	=> request()->level,
        'exp'	=> request()->exp,
        'detail'=> request()->detail
      ]);

      $mons = array_filter(request()->defeat, 'strlen');
      $monsMany = array_filter(request()->dmany, 'strlen');
      $drops = array_filter(request()->drop, 'strlen');
      $dropsMany = array_filter(request()->ddmany, 'strlen');
      $rewards = array_filter(request()->reward, 'strlen');
      $rewardMany = array_filter(request()->rmany, 'strlen');

      if(count($mons) > 0)
      {
        $i = 0;

        foreach($mons as $mon)
        {
          $quest->tujuan()->create([
              'defeat'	=> 1,
              'monster_id'	=> $mon[$i],
              'many'	=> $monsMany[$i]
          ]);

          $i++;
        }
      }

      if(count($drops) > 0)
      {
        $i = 0;

        foreach($drops as $drop)
        {
          $quest->tujuan()->create([
              'defeat'	=> 2,
              'drop_id'	=> $drop[$i],
              'many'	=> $dropsMany[$i]
          ]);

          $i++;
        }
      }

      if(count($rewards))
      {
        $i = 0;

        foreach($rewards as $reward)
        {
          $quest->reward()->create([
              'drop_id'	=> $reward[$i],
              'many'	=> $rewardMany[$i]
          ]);

          $i++;
        }
      }

      return response()->json(['success' => true]);
    }

    return view('npc.store_quest');
  }
}