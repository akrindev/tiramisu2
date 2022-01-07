<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forum;

class ForumController extends Controller
{
    /**
     * feed
     *
     * @return void
     */
    public function feed()
    {
        $feeds = Forum::withCount(['user:id,name,provider_id', 'comment'])
            ->orderByDesc('created_at')
            ->get();

        $data = $feeds->map(function ($item, $key) {
            $item->judul = str_limit(e($item->judul), 65);
            $item->body = (new \Parsedown)->text(e($item->body));
            $item->created = $item->created_at->diffForHumans();
            $item->user->name = e(explode(' ', $item->user->name)[0]);

            return $item;
        });

        return response()->json($data, 200)
            ->header('Cache-Control', 'max-age=14000, public');
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $item = Forum::whereId($id)->with([
            'user:id,name,provider_id',
            'comment' => function ($query) {
                $query->with([
                    'user:id,name,provider_id',
                    'getReply' => function ($q) {
                        $q->with('user:id,name,provider_id');
                    }
                ])
                    ->where('parent_id', null);
            }
        ])->first(); //dd(collect($read));

        $item->body = (new \Parsedown)->text(e($item->body));
        $item->created = waktu($item->created_at);

        // get comment
        $item->comment->map(function ($i, $k) {
            $i->user->name = e($i->user->name);
            $i->body = (new \Parsedown)->text(e($i->body));
            $i->created = waktu($i->created_at);

            // get reply comment
            $i->getReply->map(function ($n) {
                $n->body = (new \Parsedown)->text(e($n->body));
                $n->created = waktu($n->created_at);

                return $n;
            });

            return $i;
        });


        return response()->json($item, 200, [], JSON_PRETTY_PRINT)
            ->header('Access-Control-Allow-Origin', '*');
    }
}
