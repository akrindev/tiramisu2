<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Skill,
    SkillList,
    SkillComment
};
use App\Notifications\SkillReplied;
use Image;

class SkillController extends Controller
{
    /**
     * show all skills
     *
     * @return void
     */
    public function index()
    {
        $skills = Skill::get();

        return view('skill.index', compact('skills'));
    }

    /**
     * show
     *
     * @param  mixed $name
     * @return void
     */
    public function show($name)
    {
        $name = str_replace('-', ' ', $name);

        $skills = Skill::whereName($name)->firstOrFail();

        return view('skill.show', compact('skills', 'name'));
    }

    /**
     * showId
     *
     * @param  mixed $id
     * @return void
     */
    public function showId($id)
    {
        $skills = Skill::findOrFail($id);
        $name = $skills->name;

        return view('skill.show', compact('skills', 'name'));
    }

    /**
     * single
     *
     * @param  mixed $parent
     * @param  mixed $child
     * @return void
     */
    public function single($parent, $child)
    {
        $parent = str_replace('-', ' ', $parent);
        $name = trim(str_replace('-', ' ', $child));

        $skillparent = Skill::whereName($parent)->firstOrFail();
        $skill = $skillparent->child()->whereName($name)->firstOrFail();

        $name = is_null($skill->r_name) ? $skill->name : $skill->r_name;

        return view('skill.single', compact('skill', 'name'));
    }

    /**
     * singleChild
     *
     * @param  mixed $id
     * @return void
     */
    public function singleChild($id)
    {
        $skill = SkillList::findOrFail($id);
        $name = $skill->name;

        return view('skill.single', compact('skill', 'name'));
    }

    /**
     * comment
     *
     * @param  mixed $id
     * @return void
     */
    public function comment($id)
    {
        request()->validate([
            'body'    => 'required|min:15'
        ]);

        $skill = SkillList::findOrFail($id);

        $skill->comment()->create([
            'user_id'    => auth()->user()->id,
            'body'        => request('body')
        ]);

        $notify = $skill->comment()->where('user_id', '!=', auth()->id())->get();

        $to = collect($notify)->unique('user_id');

        foreach ($to->values()->all() as $pesan) {
            $pesan->notify(new SkillReplied('juga berkomentar', $skill));

            fcm()->to([$pesan->user->fcm->token])
                ->notification([
                    'title' => 'Seseorang juga berkomentar di ' . $skill->name,
                    'body' => explode(' ', auth()->user()->name)[0] . ' juga berkomentar di ' . $skill->name,
                    'icon'    => 'https://graph.facebook.com/' . auth()->user()->provider_id . '/picture?type=normal',
                    'click_action' => url('/skill/child/' . $id)
                ])
                ->send();
        }

        return back()->with('sukses_comment', 'komentar telah di tambahkan');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $skill = SkillList::findOrFail($id);

        return view('skill.edit', compact('skill'));
    }

    /**
     * deleteComment
     *
     * @return void
     */
    public function deleteComment()
    {
        $id = request('id');

        $skill = SkillComment::findOrFail($id);

        $skill->delete();

        return back();
    }

    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $id = request('id');

        $skill = SkillList::findOrFail($id);

        request()->validate([
            'name'    => 'required',
            'type'    => 'required',
            'body'    => 'required'
        ]);

        $skill->skill_id = request('skill');
        $skill->name = request('name');
        $skill->type = implode(',', request('type'));
        $skill->mp   = request('mp');
        $skill->range = request('range');
        $skill->for = implode(',', request('for'));
        $skill->level = request('level');
        $skill->combo_awal = request('combo_awal');
        $skill->combo_tengah = request('combo_tengah');
        $skill->element_id    = request('element');
        $skill->description    = request('body');

        if (request()->hasFile('icon')) {
            $icon = request()->file('icon')->getRealPath();

            $path = '/img/skill/thumb/' . str_slug(request()->name) . '.png';

            $img = Image::make($icon);
            $img->save(public_path($path));

            $skill->picture = $path;
        }

        $skill->save();

        return redirect('/skill/' . request()->skill)->with('sukses', 'data berhasil di ubah');
    }


    /**
     * showEdit
     *
     * @return void
     */
    public function showEdit()
    {
        $skills = Skill::get();

        return view('skill.admin.edit', compact('skills'));
    }

    /**
     * showChild
     *
     * @return void
     */
    public function showChild()
    {
        return view('skill.admin.store');
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        if (request()->hasFile('icon')) {
            $icon = request()->file('icon')->getRealPath();

            $path = '/img/skill/thumb/' . str_slug(request()->name) . '.png';

            $img = Image::make($icon);
            $img->save(public_path($path));

            $skill = Skill::create([
                'name'    => request()->name,
                'type'    => request()->type,
                'description'    => request()->body,
                'picture'    => $path
            ]);
        }

        return back()->with('sukses', 'skill telah di tambahkan');
    }

    /**
     * skillSave
     *
     * @return void
     */
    public function skillSave()
    {
        $id = request('id');

        $skill = Skill::findOrFail($id);
        $skill->name = request()->name;
        $skill->type = request()->type;
        $skill->description = request()->body;

        if (request()->hasFile('icon')) {
            $icon = request()->file('icon')->getRealPath();

            $path = '/img/skill/thumb/' . str_slug(request()->name) . rand(00, 99) . '.png';

            $img = Image::make($icon);
            $img->save(public_path($path));

            $skill->picture = $path;
        }

        $skill->save();

        return back()->with('sukses', 'Data telah di ubah');
    }

    /**
     * storeChild
     *
     * @return void
     */
    public function storeChild()
    {
        return view('skill.admin.store');
    }

    /**
     * storeChildPost
     *
     * @return void
     */
    public function storeChildPost()
    {
        if (request()->hasFile('icon')) {
            $icon = request()->file('icon')->getRealPath();

            $path = "/img/skill/thumb/" . str_slug(request()->name) . rand(00, 99) . '.png';

            $img = Image::make($icon);
            $img->save(public_path($path));

            $skill = SkillList::create([
                'name'    => request()->name,
                'skill_id'    => request()->skill,
                'type'        => implode(',', request('type')),
                'mp'        => request()->mp,
                'range'        => request()->range,
                'for'        => implode(',', request('for')),
                'level'        => request()->level,
                'combo_awal'    => request()->combo_awal,
                'combo_tengah'    => request()->combo_tengah,
                'element_id'    => request()->element,
                'description'    => request()->body,
                'picture'        => $path
            ]);
        }

        return back()->with('sukses', 'Data skill telah di tambahkan');
    }

    public function deleteChild()
    {
        $id = request("id");

        $skill = SkillList::findOrFail($id);
        $skill->delete();

        return redirect('/skill');
    }
}
