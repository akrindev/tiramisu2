<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emblem;
use App\EmblemList;

class EmblemController extends Controller
{
  public function store()
  {
    request()->validate([
    	'name'	=> 'required'
    ]);

    $emblem = Emblem::find(request('eid'));

    $emblem->child()->create([
    	'name'	=> request('name'),
      	'body'	=> request('body'),
      	'reward'=> request('reward')
    ]);

    return response()->json(['success' => true]);
  }

  public function edit($id)
  {
    $emb = EmblemList::find($id);

    return view('emblem.edit', compact('emb'));
  }

  public function editPost($id)
  {
    $emb = EmblemList::findOrFail($id);
    $emb->emblem_id = request("eid");
    $emb->name = request('name');
    $emb->body = request('body');
    $emb->reward = request('reward');
    $emb->save();

    return response()->json(['success' => true, 'id' => $emb->emblem_id]);
  }

  public function index()
  {
    $emblems = Emblem::all();

    return view('emblem.index', compact('emblems'));
  }

  public function show($id)
  {
    $emblems = Emblem::findOrFail($id);

    return view('emblem.show', compact('emblems'));
  }
}