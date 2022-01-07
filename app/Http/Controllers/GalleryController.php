<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\GalleryComment;
use App\User;
use App\Notifications\GalleryCommented;
use Image;

/**
 * GalleryController
 */
class GalleryController extends Controller
{
    /**
     * show all gallery images
     *
     * @return void
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(15);

        return view('gallery.index', [
            'data'    => $galleries
        ]);
    }

    /**
     * show single image
     *
     * @param  int $id
     * @return void
     */
    public function single($id)
    {
        $img = Gallery::with('comments')->findOrFail($id);

        $img->increment('views');

        return view('gallery.single', [
            'pos' => $img
        ]);
    }

    /**
     * show my uploaded images
     *
     * @return void
     */
    public function myGallery()
    {
        $galleries = auth()->user()->gallery()->latest()->paginate(15);

        return view('gallery.my_gallery', [
            'by'    => auth()->user()->name,
            'data'    => $galleries,
            'total'    => auth()->user()->gallery->count()
        ]);
    }

    public function getUserGallery($provider_id)
    {
        $user = User::where('provider_id', $provider_id)->firstOrFail();

        $galleries = Gallery::where('user_id', $user->id);

        return view('gallery.my_gallery', [
            'by'    => $user->name,
            'data'    => $galleries->latest()->paginate(20),
            'total'    => $galleries->count()
        ]);
    }

    public function getByTag($tag)
    {
        $galleries = Gallery::where('body', 'like', '%#' . $tag . '%')
            ->latest()
            ->paginate(20);
        $count = Gallery::where('body', 'like', '%#' . $tag . '%')->distinct()->count();

        return view('gallery.index_tag', [
            'data'    => $galleries,
            'tag' => $tag,
            'total' => $count
        ]);
    }

    public function upload()
    {
        request()->validate(
            [
                'body'    => 'min:5|max:140',
                'gambar'    => 'required|image|mimes:jpg,png,jpeg,gif|dimensions:min_width=300,min_height=150'
            ],
            [
                'dimensions' => 'Lebar min 300px dan tinggi min 150px'
            ]
        );

        $body = e(request()->body);

        if (request()->hasFile('gambar')) {
            $gambar = request()->file('gambar')->getRealPath();

            $name = substr(md5(now()), 0, 8) . '.png';

            $img = Image::make($gambar);
            $img->text('toram-id.info', 15, 30, function ($font) {
                $font->file(3);
                $font->size(34);
                $font->color('#ffffff');
                $font->align('left');
            });

            $img->save(public_path() . '/uploads/' . $name);

            $up = app('cloudinary')->uploadImg(public_path() . '/uploads/' . $name);

            unlink(public_path() . '/uploads/' . $name);

            $url_img = $up['secure_url'];
        }

        Gallery::create([
            'user_id' => auth()->id(),
            'body'    => $body,
            'gambar'    => $url_img
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $img = Gallery::findOrFail($id);

        if ($img->user_id != auth()->id()) {
            return redirect('/')->with('gagal', 'Akses Ditolak');
        }

        return view('gallery.edit', [
            'data' => $img
        ]);
    }

    public function editSubmit($id)
    {
        $img = Gallery::findOrFail($id);

        if ($img->user_id != auth()->id()) {
            return redirect('/')->with('gagal', 'Akses Ditolak');
        }

        request()->validate([
            'body'    => 'required|min:5|max:140'
        ]);

        $img->update([
            'body'    => e(request()->body)
        ]);

        return back()->with('sukses', 'Data telah di ubah!');
    }

    /**
     * comment to gallery image
     *
     * @param  int $id
     * @return void
     */
    public function comment($id)
    {
        $gallery = Gallery::findOrFail($id);

        request()->validate([
            'body'    => 'required|min:5'
        ]);

        $gallery->comments()->create([
            'user_id'    => auth()->id(),
            'body'    => e(request()->body)
        ]);

        if (auth()->id() != $gallery->user_id) {
            $gallery->notify(
                new GalleryCommented(
                    'Mengomentari gambar ',
                    $gallery,
                    $gallery->comments()->latest()->first()
                )
            );


            if ($gallery->user->fcm()->count() > 0) {
                fcm()->to([$gallery->user->fcm->token])
                    ->notification([
                        'title' => 'Gambar anda mendapat komentar',
                        'body' => explode(' ', auth()->user()->name)[0] . ' Mengomentari gambar anda ',
                        'icon'    => 'https://graph.facebook.com/' . auth()->user()->provider_id . '/picture?type=normal',
                        'click_action' => 'https://toram-id.info/gallery/' . $gallery->id
                    ])
                    ->send();
            }
        }

        return back()->with('sukses_comment', 'Komentar ditambahkan');
    }
    /**
     *
     * Admin / gambar milik user berhak menghapus
     */
    public function destroy()
    {
        $img = Gallery::findOrFail(request()->id);

        if ($img->user_id != auth()->id()) {
            if (auth()->user()->role == 'member') {
                return redirect('/')->with('gagal', 'Akses Ditolak');
            }
        }

        if ($img->delete()) {
            return redirect('/gallery')->with('sukses', 'Gambar di hapus');
        }
    }

    public function destroyComment()
    {
        $comment = GalleryComment::findOrFail(request()->id);

        if (auth()->user()->role == 'member') {
            return redirect('/')->with('gagal', 'Akses Ditolak');
        }

        if ($comment->delete()) {
            return back()->with('sukses', 'komentar di hapus');
        }
    }
}
