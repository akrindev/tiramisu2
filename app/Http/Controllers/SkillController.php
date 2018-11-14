<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  Skill, SkillList, SkillComment
};
use App\Notifications\SkillReplied;

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

  public function single($parent, $child)
  {
    $parent = str_replace('-', ' ', $parent);
    $name = trim(str_replace('-', ' ', $child));

    $skillparent = Skill::whereName($parent)->firstOrFail();
    $skill = $skillparent->child()->whereName($name)->firstOrFail();

    return view('skill.single', compact('skill', 'name'));
  }

  public function comment($parent, $child)
  {
    request()->validate([
    	'body'	=> 'required|min:15'
    ]);

    $parent = str_replace('-', ' ', $parent);
    $name = trim(str_replace('-', ' ', $child));

    $skillparent = Skill::whereName($parent)->firstOrFail();
    $skill = $skillparent->child()->whereName($name)->firstOrFail();

    $skill->comment()->create([
    	'user_id'	=> auth()->user()->id,
      	'body'		=> request('body')
    ]);

    $notify = $skill->comment()->where('user_id', '!=', auth()->id())->get();

    $to = collect($notify)->unique('user_id');

    foreach($to->values()->all() as $pesan)
    {
      $pesan->notify(new SkillReplied('juga berkomentar', $skill));

       fcm()->to([$pesan->user->fcm->token])
         ->notification([
         	'title' => 'Seseorang juga berkomentar di '. $skill->name,
           	'body' => explode(' ',auth()->user()->name)[0] . ' juga berkomentar di '. $skill->name,
           	'icon'	=> 'https://graph.facebook.com/'.auth()->user()->provider_id.'/picture?type=normal',
              	'click_action' => url('/skill/'.str_replace(' ', '-', $parent).'/'.str_replace(' ', '-', $name))
         ])
         ->send();
    }

    return back()->with('sukses_comment', 'komentar telah di tambahkan');
  }

  public function edit($id)
  {
    $skill = SkillList::findOrFail($id);

    return view('skill.edit', compact('skill'));
  }

  public function deleteComment()
  {
    $id = request('id');

    $skill = SkillComment::findOrFail($id);

    $skill->delete();

    return back();
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
    $skill->for = implode(',', request('for'));
    $skill->level = request('level');
    $skill->combo_awal = request('combo_awal');
    $skill->combo_tengah = request('combo_tengah');
    $skill->element_id	= request('element');
    $skill->description	= request('body');

    if($skill->save())
      return redirect('/skill/'.str_replace(' ','-',$skill->skill->name))->with('sukses', 'data berhasil di ubah');
  }
}