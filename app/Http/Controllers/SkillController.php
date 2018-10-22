<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  Skill, SkillList
};

class SkillController extends Controller
{
  public function index()
  {
    $skills = Skill::get();

    return view('skill.index', compact('skills'));
  }

  public function show($name)
  {
    $name = str_replace('-', ' ', $name);

    $skills = Skill::whereName($name)->firstOrFail();

    return view('skill.show', compact('skills', 'name'));
  }

  public function edit()
  {
    $id = request('id');

    $skill = SkillList::findOrFail($id);

    return view('skill.edit', compact('skill'));
  }

  public function save()
  {
    $id = request('id');

    $skill = SkillList::findOrFail($id);

    request()->validate([
    	'name'	=> 'required',
      	'type'	=> 'required',
      	'body'	=> 'required'
    ]);

    $skill->skill_id = request('skill');
    $skill->name = request('name');
    $skill->type = implode(',',request('type'));
    $skill->mp   = request('mp');
    $skill->range = request('range');
    $skill->combo_awal = request('combo_awal');
    $skill->combo_tengah = request('combo_tengah');
    $skill->element_id	= request('element');
    $skill->description	= request('body');

    if($skill->save())
      return redirect('/skill/'.str_replace(' ','-',$skill->skill->name))->with('sukses', 'data berhasil di ubah');
  }
}