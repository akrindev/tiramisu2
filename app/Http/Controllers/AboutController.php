<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    /**
     * kebijakanPrivasi
     *
     * @return void
     */
    public function kebijakanPrivasi()
    {
        return view('about.kebijakan_privasi');
    }

    /**
     * rules
     *
     * @return void
     */
    public function rules()
    {
        return view('about.rules');
    }

    /**
     * about
     *
     * @return void
     */
    public function about()
    {
        $data = About::latest()->first();

        return view('about.us', compact('data'));
    }

    /**
     * editAbout
     *
     * @return void
     */
    public function editAbout()
    {
        $about = About::latest()->first();

        if (request()->input()) {
            $about->body = request()->body;
            $about->save();

            return response()->json(['success' => true]);
        }

        return view('about.editabout', compact('about'));
    }
}
