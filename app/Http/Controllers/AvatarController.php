<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\AvatarList;
use Image;

class AvatarController extends Controller
{
    /**
     * show all avatar list
     *
     * @return void
     */
    public function show()
    {
        $avatars = Avatar::with('lists')->get();

        return view('avatar.home', compact('avatars'));
    }

    /**
     * show single avatar list
     *
     * @param  mixed  $id
     * @return void
     */
    public function showAvatar($id)
    {
        $avatar = Avatar::with('lists')->findOrFail($id);

        return view('avatar.show', compact('avatar'));
    }

    // admin
    public function getListAvatarJson()
    {
        $lists = AvatarList::where('title', 'like', '%'.request()->q.'%')->paginate(20);

        return $lists;
    }

    /**
     * add new avatar list
     *
     * @return void
     */
    public function storeAvatar()
    {
        request()->validate([
            'title' => 'required',
            'cover' => 'required|image',
        ]);

        $file = request()->file('cover')->getRealPath();

        $location = '/img/avatar/'.str_slug(strtolower(request('title'))).'-'.rand(00000, 99999).'.png';

        $make = Image::make($file);

        $make->text('toram-id.info', 15, 25, function ($font) {
            $font->file(public_path('/assets/fonts/roboto.ttf'));
            $font->size(20);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('bottom');
        });

        $lists = AvatarList::findOrFail(request()->lists);

        $make->save(public_path($location));

        $avatar = Avatar::create([
            'title' => request('title'),
            'title_en' => request('title_en') ?? request('title'),
            'cover' => $location,
        ]);

        $avatar->lists()->sync($lists);

        return response()->json(['success' => true]);
    }

    /**
     * storeAvatarList
     *
     * @return void
     */
    public function storeAvatarList()
    {
        request()->validate([
            'title' => 'required',
            'image' => 'required|image',
        ]);

        $file = request()->file('image')->getRealPath();

        $location = '/img/avatar/'.str_slug(strtolower(request('title'))).'-'.rand(00000, 99999).'.png';

        $make = Image::make($file);

        $make->text('toram-id.info', 20, 50, function ($font) {
            $font->file(public_path('/assets/fonts/roboto.ttf'));
            $font->size(34);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('bottom');
        });

        $make->save(public_path($location));

        $avatar = AvatarList::create([
            'title' => request('title'),
            'title_en' => request('title_en') ?? request('title'),
            'rate' => request('rate'),
            'value' => request('value'),
            'type' => request('type'),
            'image' => $location,
        ]);

        return response()->json(['success' => true]);
    }

    // edit avatar
    public function editAvatar($id)
    {
        if (request()->isMethod('GET')) {
            $data = Avatar::findOrFail($id);

            return view('avatar.admin.edit_avatar', compact('data'));
        }

        $avatar = Avatar::findOrFail($id);

        request()->validate([
            'title' => 'required',
        ]);

        if (request()->hasFile('cover')) {
            $file = request()->file('cover')->getRealPath();

            $location = '/img/avatar/'.str_slug(strtolower(request('title'))).'-'.rand(00000, 99999).'.png';

            $make = Image::make($file);

            $make->text('toram-id.info', 15, 25, function ($font) {
                $font->file(public_path('/assets/fonts/roboto.ttf'));
                $font->size(20);
                $font->color('#ffffff');
                $font->align('left');
                $font->valign('bottom');
            });

            $make->save(public_path($location));
        }

        $lists = AvatarList::findOrFail(request()->lists);

        $avatar->update([
            'title' => request('title'),
            'title_en' => request('title_en') ?? request('title'),
            'cover' => $location ?? $avatar->cover,
        ]);

        $avatar->lists()->sync($lists);

        return response()->json(['success' => true]);
    }

    /**
     * editAvatarList
     *
     * @param  mixed  $id
     * @return void
     */
    public function editAvatarList($id)
    {
        if (request()->isMethod('GET')) {
            $data = AvatarList::findOrFail($id);

            return view('avatar.admin.edit_lists', compact('data', 'id'));
        }
        $avatar = AvatarList::findOrFail($id);

        request()->validate([
            'title' => 'required',
        ]);

        if (request()->hasFile('image')) {
            $file = request()->file('image')->getRealPath();

            $location = '/img/avatar/'.str_slug(strtolower(request('title'))).'-'.rand(00000, 99999).'.png';

            $make = Image::make($file);

            $make->text('toram-id.info', 20, 50, function ($font) {
                $font->file(public_path('/assets/fonts/roboto.ttf'));
                $font->size(34);
                $font->color('#ffffff');
                $font->align('left');
                $font->valign('bottom');
            });

            $make->save(public_path($location));
            $avatar->image = $location;
            $avatar->save();
        }

        $avatar->update([
            'title' => request('title'),
            'title_en' => request('title_en') ?? request('title'),
            'rate' => request('rate'),
            'value' => request('value'),
            'type' => request('type'),
        ]);

        return response()->json(['success' => true]);
    }

    //get list
    public function getListJson($id)
    {
        $avatar = Avatar::find($id);
        $data = $avatar->lists()->get();

        return $data;
    }

    /**
     * deleteAvatar
     *
     * @return void
     */
    public function deleteAvatar()
    {
        $id = request()->id;
        $avatar = Avatar::findOrFail($id);
        $avatar->delete();

        return response()->json(['success' => true]);
    }

    /**
     * deleteAvatarList
     *
     * @param  mixed  $id
     * @return void
     */
    public function deleteAvatarList($id)
    {
        $avatar = AvatarList::findOrFail($id);
        $avatar->delete();

        return response()->json(['success' => true]);
    }
}
