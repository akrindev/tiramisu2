<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumCategory;
use App\ForumsDesc;
use App\Notifications\ThreadReplied;
use App\Tag;
use Auth;
use Illuminate\Http\Request;
use Image;

/**
 * ForumController
 */
class ForumController extends Controller
{
    /**
     * feed
     *
     * @return void
     */
    public function feed()
    {
        $forums = Forum::with(['user', 'comment'])->orderByDesc('pinned')
            ->latest()
            ->paginate(20);

        $title = 'Forum Toram Online Indonesia';
        $f_title = 'Recent Discussions';
        $categories = ForumCategory::with('forum')->get();

        return view('forum.feed', compact('forums', 'categories', 'title', 'f_title'));
    }

    /**
     * post a forum post
     *
     * @return void
     */
    public function buat()
    {
        $tags = Tag::get();
        $categories = ForumCategory::get();

        return view('forum.buat', compact('tags', 'categories'));
    }

    /**
     * store forum post
     *
     * @return void
     */
    public function buatSubmit()
    {
        request()->validate([
            'judul' => 'required|min:5',
            'deskripsi' => 'required|min:20',
        ]);

        $slug = substr(str_slug(request('judul')), 0, 20).'-'.substr(sha1(now()), 0, 8);

        $tags = request('tags');

        $i = 0;

        foreach ($tags as $tag) {
            $secondTags[] = $tag;
            $i++;
            if ($i == 4) {
                break;
            }
        }

        $category = ForumCategory::find(request('kategori', 1));

        $forum = Forum::create([
            'user_id' => Auth::user()->id,
            'judul' => request('judul'),
            'slug' => $slug,
            'body' => request('deskripsi'),
            'tags' => implode(',', $secondTags),
            'color' => request('color') ?? 'yellow',
            'forum_category_id' => $category->id,
        ]);

        return redirect('/forum/'.$slug)->with('sukses', 'Thread berhasil dibuat');
    }

    /**
     * read forum post
     *
     * @param  string  $slug
     * @return void
     */
    public function baca($slug)
    {
        $baca = Forum::with([
            'user',
            'comment' => function ($query) {
                $query->with(['user', 'likes', 'getReply']);
            },
            'category',
        ])
            ->where('slug', $slug)->firstOrFail();

        $comments = $baca->comment;

        $baca->increment('views');

        return view('forum.baca', [
            'data' => $baca,
            'comments' => $comments,
        ]);
    }

    /**
     * read forum post by id
     *
     * @param  int  $id
     * @return void
     */
    public function bacaId($id)
    {
        $baca = Forum::findOrFail($id);

        return redirect('/forum/'.$baca->slug);
    }

    /**
     * comment to forum post
     *
     * @param  string  $slug
     * @return void
     */
    public function comment($slug)
    {
        $forum = Forum::where('slug', $slug)->firstOrFail();

        request()->validate([
            'body' => 'required',
        ]);

        $comment = ForumsDesc::create([
            'user_id' => Auth::user()->id,
            'forum_id' => $forum->id,
            'body' => request('body'),
        ]);

        if (auth()->id() != $forum->user_id) {
            $forum->notify(
                new ThreadReplied(
                    'Menjawab di',
                    $forum,
                    $forum->comment()->latest()->first()
                )
            );

            // if ($forum->user->fcm()->count() > 0) {
            //     fcm()->to([$forum->user->fcm->token])
            //         ->notification([
            //             'title' => 'Forum anda mendapat komentar',
            //             'body' => explode(' ', auth()->user()->name)[0] . ' Menjawab pada ' . $forum->judul,
            //             'icon'    => 'https://graph.facebook.com/' . auth()->user()->provider_id . '/picture?type=normal',
            //             'click_action' => 'https://toram-id.com/forum/' . $forum->slug
            //         ])
            //         ->send();
            // }
        }

        return back()->with('sukses_comment', 'Komentar di tambahkan');
    }

    /**
     * reply to comment forum post
     *
     * @param  mixed  $slug
     * @return void
     */
    public function commentReply($slug)
    {
        $forum = Forum::where('slug', $slug)->firstOrFail();

        $id = request('id');

        request()->validate([
            'reply' => 'required',
        ]);

        $comment = $forum->comment()->create([
            'user_id' => Auth::user()->id,
            'forum_id' => $forum->id,
            'parent_id' => $id,
            'body' => request('reply'),
        ]);

        $replied = ForumsDesc::find($id);

        if (auth()->id() != $replied->user_id) {
            $replied->notify(
                new ThreadReplied(
                    'Membalas di',
                    $forum,
                    $forum->comment()->latest()->first()
                )
            );

            // if ($replied->user->fcm()->count() > 0) {
            //     fcm()->to([$replied->user->fcm->token])
            //         ->notification([
            //             'title' => 'Komentar anda mendapat balasan',
            //             'body' => explode(' ', auth()->user()->name)[0] . ' Membalas pada ' . $forum->judul,
            //             'icon'    => 'https://graph.facebook.com/' . auth()->user()->provider_id . '/picture?type=normal',
            //             'click_action' => 'https://toram-id.com/forum/' . $forum->slug
            //         ])
            //         ->send();
            // }
        }

        return back()->with('sukses_reply-'.$id, 'balasan di tambahkan');
    }

    /**
     * edit thread
     */
    public function edit($slug)
    {
        $data = Forum::where('slug', $slug)->firstOrFail();

        if (Auth::user()->id != $data->user_id) {
            return redirect('/')->with('gagal', 'Tidak punya hak akses ini!!');
        }

        $categories = ForumCategory::get();

        return view('forum.edit', compact('data', 'categories'));
    }

    /**
     * update forum post
     *
     * @param  string  $slug
     * @return void
     */
    public function editSubmit($slug)
    {
        $thread = Forum::where('slug', $slug)->firstOrFail();

        if (Auth::user()->id != $thread->user_id) {
            return redirect('/')->with('gagal', 'Tidak punya hak akses ini!!');
        }

        request()->validate([
            'judul' => 'required|min:5',
            'deskripsi' => 'required|min:20',
        ]);

        $tags = request('tags');

        $i = 0;

        foreach ($tags as $tag) {
            $secondTags[] = $tag;
            $i++;
            if ($i == 4) {
                break;
            }
        }

        $category = ForumCategory::find(request('kategori'));

        $thread->update([
            'judul' => request('judul'),
            'body' => request('deskripsi'),
            'tags' => implode(',', $secondTags),
            'color' => request('color') ?? 'yellow',
            'forum_category_id' => $category->id,
        ]);

        return redirect('/forum/'.$thread->slug)->with('sukses', 'Thread Updated!!');
    }

    /**
     * editKategori
     *
     * @return void
     */
    public function editKategori()
    {
        $categories = ForumCategory::get();

        return view('forum.admin.storeKategori', compact('categories'));
    }

    /**
     * storeKategori
     *
     * @return void
     */
    public function storeKategori()
    {
        request()->validate([
            'name' => 'required',
        ]);

        ForumCategory::create([
            'name' => request()->name,
            'slug' => str_slug(request('slug', request()->name)),
        ]);

        return back()->with('success', 'Kategori baru telah di tambahkan');
    }

    /**
     * postEditKategori
     *
     * @return void
     */
    public function postEditKategori()
    {
        $kategori = ForumCategory::findOrFail(request()->id);

        $kategori->name = request()->name;
        $kategori->slug = request('slug', request()->name);

        $kategori->save();

        return back()->with('success', 'Kategori berhasil di edit');
    }

    /**
     * Show by tag
     */
    public function byTag($nya)
    {
        $forums = Forum::where('tags', 'like', '%'.$nya.'%')
            ->latest()
            ->paginate(20);

        $title = 'Tag Forum : '.$nya;
        $categories = ForumCategory::get();

        return view('forum.feed', compact('forums', 'categories', 'title'));
    }

    /**
     * category
     *
     * @param  mixed  $slug
     * @return void
     */
    public function category($slug)
    {
        $category = ForumCategory::whereSlug($slug)->firstOrFail();
        $forums = $category->forum()->latest()->paginate(20);

        $title = $category->name;
        $categories = ForumCategory::get();

        return view('forum.feed', compact('forums', 'categories', 'title'));
    }

    /**
     * cari berdasarkan judul forum
     */
    public function cari()
    {
        $key = request('key');
        $forums = Forum::where('judul', 'like', '%'.$key.'%')->latest()->paginate(20);

        $categories = ForumCategory::with('forum')->get();

        $title = 'Forum Toram Online Indonesia';
        $f_title = 'Pencarian: '.$key;

        return view('forum.feed', compact('forums', 'title', 'f_title', 'categories'));
    }

    /**
     * pin the thread
     * hanya admin yang bisa melakukan pin thread
     */
    public function pinned($slug)
    {
        $forum = Forum::where('slug', $slug)->firstOrFail();

        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('gagal', 'Kamu tidak punya hak akses ini!');
        }

        if (request('pinthis') == 1) {
            $update = ['pinned' => 1];
            $message = 'Thread has been PINNED!';
        } else {
            $update = ['pinned' => 0];
            $message = 'Thread has been UNPINNED!';
        }

        if ($forum->update($update)) {
            return back()->with('sukses', $message);
        }
    }

    /**
     * Delete thread
     */
    public function delete($slug)
    {
        $forum = Forum::where('slug', $slug)->firstOrFail();

        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('gagal', 'Kamu tidak punya hak akses ini!');
        }

        if ($forum->delete()) {
            return redirect('/')->with('sukses', 'Thread di hapus');
        }
    }

    // delete by user
    public function deleteByUser($slug)
    {
        $forum = Forum::where('slug', $slug)->firstOrFail();

        if (Auth::id() == $forum->user_id) {
            if ($forum->delete()) {
                return redirect('/')->with('sukses', 'Thread di hapus');
            }
        } else {
            return redirect('/')->with('gagal', 'Kamu tidak punya hak akses ini!');
        }
    }

    /**
     * delete komentar
     */
    public function deleteComment()
    {
        $forum = ForumsDesc::findOrFail(request('cid'));

        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('gagal', 'Kamu tidak punya hak akses ini!');
        }

        if ($forum->delete()) {
            return back()->with('sukses', 'komentar di hapus');
        }
    }

    public function uploader()
    {
        //  return response()->json(request()->file('gambar'));
        if (request()->hasFile('gambar')) {
            $gambar = request()->file('gambar')->getRealPath();

            $name = substr(md5(now()), 0, 8).'.png';

            $img = Image::make($gambar);
            $img->text('toram-id.com', 15, 30, function ($font) {
                $font->file(3);
                $font->size(34);
                $font->color('#ffffff');
                $font->align('left');
            });
            $img->save(public_path().'/uploads/'.$name);

            $up = app('cloudinary')->uploadImg(public_path().'/uploads/'.$name);

            unlink(public_path().'/uploads/'.$name);

            $url_img = $up['secure_url'];

            return response()->json([
                'url' => $url_img,
                'token' => csrf_token(),
            ]);
        }

        return false;
    }

    /**
     * forum like
     */
    public function postLike()
    {
        $thread = Forum::findOrFail(request()->id);

        if (auth()->user()->hasLikedThread($thread) || ! auth()->check()) {
            return response()->json(['sukses' => false]);
        }

        $like = $thread->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['sukses' => true]);
    }

    /**
     * like reply comment
     *
     * @return void
     */
    public function postLikeReply()
    {
        $reply = ForumsDesc::findOrFail(request()->id);

        if (auth()->user()->hasLikedThreadReply($reply) || ! auth()->check()) {
            return response()->json(['sukses' => false]);
        }

        $like = $reply->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['sukses' => true]);
    }
}
