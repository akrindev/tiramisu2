<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\BgMusic;
use App\BgMusicComment as Comment;

class BgmController extends Controller
{
    /**
     * show
     *
     * @return void
     */
    public function show()
    {
        $bgm = BgMusic::all();

        return view('bgm.show', [
            'musics' => $bgm
        ]);
    }

    /**
     * single
     *
     * @param  mixed $slug
     * @return void
     */
    public function single($slug)
    {
        $bgm = BgMusic::where('slug', $slug)->firstOrFail();
        $random = BgMusic::inRandomOrder()->take(5)->get();

        return view('bgm.single', [
            'bgm' => $bgm,
            'random' => $random
        ]);
    }

    /**
     * postComment
     *
     * @param  mixed $slug
     * @return void
     */
    public function postComment($slug)
    {
        $bgm = BgMusic::where('slug', $slug)->firstOrFail();

        request()->validate([
            'body' => 'required'
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->id();
        $comment->bg_music_id = $bgm->id;
        $comment->body = request()->body;

        if ($comment->save()) {
            return back()->with('sukses_comment', 'komentar di tambahkan');
        }
    }

    /**
     * destroy
     *
     * @return void
     */
    public function destroy()
    {
        $bgm = BgMusic::findOrFail(request()->id);

        if (auth()->user()->role == 'member') {
            return redirect('/')->with('gagal', 'Akses ditolak');
        }

        if ($bgm->delete()) {
            return back()->with('sukses_comment', 'Komentar di hapus');
        }
    }

    private function cokot($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $uaa = $_SERVER['HTTP_USER_AGENT'];
        curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent: $uaa");
        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        curl_setopt($ch, CURLOPT_REFERER, 'https://www.yt-download.org/');

        return curl_exec($ch);
    }

    private function grab($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $uaa = 'Mozilla/5.0 (Linux; U; Android 4.2.2; en-US; Lenovo A369i Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.4.1.565 U3/0.8.0 Mobile Safari/534.30';
        curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent: $uaa");

        return curl_exec($ch);
    }
    //     public function scrap()
    //     {
    //       $api = 'AIzaSyA_j1Z6Boqg-XAaEHSHMZY_8KOrkK6yn_k';
    //       $lists = 'PLahH7pRc9y35TtpESZIvDC1l7tDVx2Idn';

    //       $curl = $this->grab('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$lists.'&key='.$api.'&pageToken=CDIQAA&maxResults=50');

    //       $daftar = json_decode($curl);

    // // //     dd($daftar);
    // //       foreach ($daftar->items as $each)
    // //       {
    // //         $title = "Toram online [BGM] - ".str_replace('[Regular Maps]','',$each->snippet->title);
    // //         $bg = new BgMusic;
    // //         $bg->title = $title;
    // //         $bg->slug = str_slug($title).'-'.str_random(8);
    // //         $bg->video_id = $each->snippet->resourceId->videoId;
    // //         $bg->pada = Carbon::parse($each->snippet->publishedAt)->toDateTimeString();
    // //         $bg->channel_id = $each->snippet->channelId;
    // //         $bg->channel_title = $each->snippet->channelTitle;
    // //         $bg->save();
    // //         echo "<font color='green'>sukses</font>";
    // //         echo "<hr>";
    // //       }

    //     }

}
