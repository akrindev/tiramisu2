<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use \File;
use App\Helpers\SaveAsImage as Image;

use App\Guild;

class GuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = Guild::latest()->paginate();

        return view('guild.index', compact('guilds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name' => ['required', 'max:16'],
            'description' => ['required'],
            'logo' => ['required', 'image', 'max:1024'],
            'level' => ['required', 'integer', 'min:1', 'max:49']
        ]);

        $file = $request->file('logo')->getRealPath();

        $name = '/img/guild/'. Str::slug($request->name) . '-' .time(). '.png';

        (new Image)->file($file)->name($name)->save();

        $data['logo'] = $name;

        $guild = Guild::create($data + ['manager_id' => auth()->id()]);

        $guild->users()->attach($request->user(), ['role' => 'ketua', 'manager_id' => auth()->id()]);

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
        $guild = Guild::findOrFail($id);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
