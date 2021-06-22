<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use \File;
use App\Helpers\SaveAsImage as Image;
use App\Helpers\Food;

use App\Guild;
use App\User;

class GuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = Guild::with([
            'users' => function ($query) {
                $query->with('contribution');
            }
        ])
            ->when(request()->has('search'), function ($query) {
                $query->where('name', 'like', '%' . request()->search . '%');
            })
            ->latest()->paginate();

        return view('guild.index', compact('guilds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Guild::class);

        return view('guild.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Guild::class);

        $data = $request->validate([
            'name' => ['required', 'max:16', 'unique:guilds,name'],
            'description' => ['required'],
            'logo' => ['required', 'image', 'max:1024'],
            'level' => ['required', 'integer', 'min:1', 'max:49']
        ], [
            'name.unique'   => 'Nama guild ini sudah digunakan'
        ]);

        $file = $request->file('logo')->getRealPath();

        $name = '/img/guild/' . Str::slug($request->name) . '-' . time() . '.png';

        (new Image)->file($file)->name($name)->save();

        $data['logo'] = $name;

        $guild = Guild::create($data + ['manager_id' => auth()->id()]);

        $guild->users()->attach($request->user(), [
            'role' => 'ketua',
            'manager_id' => auth()->id(),
            'accept'    => 1
        ]);

        session()->flash('success', 'Guild baru telah di buat');

        return redirect()->intended('/guilds');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guild = Guild::with([
            'users' => function ($query) {
                $query->with(['cooking', 'secondCooking', 'contribution']);
            }
        ])->findOrFail($id);

        return view('guild.show', compact('guild'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guild = Guild::findOrFail($id);

        $this->authorize('update', $guild);

        return view('guild.edit', compact('guild'));
    }

    /**
     * Add memer to guild
     */
    public function addMember($id)
    {
        $guild = Guild::findOrFail($id);
        $this->authorize('add-member', $guild);

        $data = \request()->validate([
            'name' => ['required', 'exists:users,username'],
            'role'  => ['required', 'in:wakil,inviter,member']
        ], [
            'name.exists'   => 'username tidak di temukan',
            'role.in'   => 'role tidak valid'
        ]);

        $user = \App\User::where('username', '=', $data['name'])->first();

        $has = $guild->users()->wherePivot('user_id', $user->id)
            // ->wherePivot('user_id', '!=', auth()->id())
            // ->wherePivot('accept', '=', 0)
            ->first();

        if (!$has) {
            $guild->users()->attach($user->id, [
                'role'  => $data['role'],
                'manager_id' => auth()->id(),
                'accept' => 0
            ]);

            session()->flash('success', 'Undangan guild telah di kirimkan, dan menunggu user untuk menerima undangan guild anda');
        } else {
            session()->flash('failed', 'username pernah di tambahkan');
        }

        return \back();
    }
    /**
     * remove member
     */
    public function removeMember($id)
    {
        request()->validate([
            'memid' => ['required']
        ]);

        $guild = Guild::findOrFail($id);

        $this->authorize('remove-member', $guild);

        $guild->users()->detach(request()->memid);

        session()->flash('success', 'member di hapus');

        return \back();
    }

    // make as ketua guild
    public function pindahKetuaSerikat($id)
    {
        request()->validate([
            'memid' => ['required']
        ]);

        $guild = Guild::findOrFail($id);
        $user = User::findOrFail(request()->memid);

        $this->authorize('manager', $guild);

        $avail = $guild->users()->wherePivot('user_id', $user->id)
            ->wherePivot('accept', 0)
            ->first();

        if ($avail) {
            session()->flash('failed', 'belum menjadi member serikat');

            return back();
        }

        auth()->user()->guilds()->updateExistingPivot($guild->id, ['role' => 'wakil']);
        $user->guilds()->updateExistingPivot($guild->id, ['role' => 'ketua']);
        $guild->forceFill([
            'manager_id'    => $user->id
        ])->save();

        session()->flash('success', 'Ketua guild telah di ganti');

        return redirect('guilds/' . $guild->id);
    }

    // acceptable guild invitation
    public function accepting($id)
    {
        $guild = Guild::findOrFail($id);

        $user = $guild->users()->wherePivot('user_id', auth()->id())
            ->first();

        if (\request()->has('y')) {
            $guild->users()->updateExistingPivot($user->id, ['accept' => 1]);
        } else {
            $guild->users()->detach($user->id);
        }

        return redirect('guilds/' . $guild->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guild = Guild::findOrFail($id);

        $this->authorize('update', $guild);

        $data = $request->validate([
            'name' => [
                Rule::requiredIf($guild->isManager()),
                'max:16',
                'unique:guilds,name,' . $guild->id
            ],
            'description' => ['required'],
            'logo' => ['image', 'max:1024'],
            'level' => ['required', 'integer', 'min:1', 'max:49']
        ], [
            'name.unique'   => 'Nama guild ini sudah digunakan'
        ]);

        if ($request->hasFile('logo')) {

            $file = $request->file('logo')->getRealPath();

            $name = '/img/guild/' . Str::slug($request->name) . '-' . time() . '.png';

            (new Image)->file($file)->name($name)->save();
            (new Filesystem)->delete(public_path($guild->logo));

            $data['logo'] = $name;
        }


        $guild->update($data);

        session()->flash('success', 'Guild telah di edit');

        return \redirect('guilds/' . $guild->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guild = Guild::findOrFail($id);

        $this->authorize('delete-guild', $guild);
        $guild->users()->detach();
        $guild->delete();

        session()->flash('success', 'guild berhasil di bubarkan');

        return redirect()->intended('guilds');
    }
}
