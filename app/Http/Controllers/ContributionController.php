<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\ContributionDrop as CoDrop;
use App\Drop;
use App\DropDone;
use Image;

/**
 * Contribution
 */
class ContributionController extends Controller
{
    /**
     * show
     *
     * @return void
     */
    public function show()
    {
        $drops = Drop::whereIn('drop_type_id', [13, 14, 15, 25, 26, 27, 28, 29, 30, 31, 32, 33])
            ->whereDoesntHave('dropDone')
            ->orderBy('drop_type_id')
            ->paginate(30);

        return view('contribution.show', compact('drops'));
    }

    /**
     * edit
     *
     * @return void
     */
    public function edit()
    {
        $drop = auth()->user()->contributionDrop()->create([
            'drop_id' => request('id'),
            'name' => request('name'),
        ]);

        if (request()->hasFile('picture')) {
            $file = request()->file('picture')->getRealPath();

            $nama = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000, 99999).'.png';

            $make = Image::make($file);

            $make->text('toram-id.info', 15, 30, function ($font) {
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

        return response()->json(['success' => true]);
    }

    /**
     * mySubmition
     *
     * @return void
     */
    public function mySubmition()
    {
        $data = auth()->user()->contributionDrop()
            ->latest()
            ->paginate(30);

        return view('contribution.my_contribution', compact('data'));
    }

    /**
     * moderasi
     *
     * @return void
     */
    public function moderasi()
    {
        $mods = CoDrop::whereAccepted(0)->latest()->paginate(30);

        return view('contribution.moderasi', compact('mods'));
    }

    /**
     * sudoModerasi
     *
     * @return void
     */
    public function sudoModerasi()
    {
        $from = CoDrop::findOrFail(request('id'));
        $to = Drop::findOrFail($from->drop_id);

        $to->name = $from->name;

        if (! is_null($from->picture)) {
            $to->picture = $from->picture;

            Contribution::updateOrCreate(['user_id' => $from->user_id])->increment('point', 5);
        }

        $from->accepted = 1;

        $from->save();
        $to->save();

        DropDone::create(['drop_id' => $to->id]);

        Contribution::updateOrCreate(['user_id' => $from->user_id])->increment('point', 3);

        return response()->json(['success' => true]);
    }

    /**
     * fetch
     *
     * @param  mixed  $id
     * @return void
     */
    public function fetch($id)
    {
        $drop = Drop::findOrFail($id);

        return response()->json($drop);
    }
}
