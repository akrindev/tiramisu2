<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  Contribution, ContributionDrop as CoDrop, DropDone, Drop
};
use Image;

class ContributionController extends Controller
{
  public function show()
  {
    $drops = Drop::whereIn('drop_type_id', [13, 14, 15, 25, 26, 27, 28, 29, 30, 31, 32, 33])
      ->whereDoesntHave('dropDone')
      ->orderBy('drop_type_id')
      ->paginate(30);

    return view('contribution.show', compact('drops'));
  }

  public function edit()
  {
    $drop = auth()->user()->contributionDrop()->create([
    	'drop_id'	=> request('id'),
      	'name'		=> request('name'),
    ]);

    if(request()->hasFile('picture'))
    {
      $file = request()->file('picture')->getRealPath();

      $nama = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

      $make = Image::make($file);

      $make->text('toram-id.info',15,30, function($font)
          {
              $font->file(3);
              $font->size(34);
              $font->color('#ffffff');
              $font->align('left');
              $font->valign('bottom');
          });

      $make->save(public_path($nama));


      $drop->picture = $nama;
      $drop->save();
    }

    return response()->json(["success"=>true]);

  }

  public function mySubmition()
  {
    $data = auth()->user()->contributionDrop()
      ->latest()
      ->paginate(30);

    return view('contribution.my_contribution', compact('data'));
  }

  public function moderasi()
  {
    $mods = CoDrop::whereAccepted(0)->latest()->paginate(30);

    return view('contribution.moderasi', compact('mods'));
  }

  public function sudoModerasi()
  {
    $from = CoDrop::findOrFail(request('id'));
    $to = Drop::findOrFail($from->drop_id);

    $to->name = $from->name;

    if(! is_null($from->picture)):
    	$to->picture = $from->picture;

    	auth()->user()->contribution()->updateOrCreate([])->increment('point',5);
    endif;

    $from->accepted = 1;

    $from->save();
    $to->save();

    DropDone::create(['drop_id'=> $to->id]);

    auth()->user()->contribution()->updateOrCreate([])->increment('point',3);


    return response()->json(['success'=>true]);
  }

  public function fetch($id)
  {
    $drop = Drop::findOrFail($id);

    return response()->json($drop);
  }
}