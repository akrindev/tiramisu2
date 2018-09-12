<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    public function kebijakanPrivasi()
    {
      return view('about.kebijakan_privasi');
    }

  	public function rules()
    {
      return view('about.rules');
    }

  	public function about()
    {
      $data = About::latest()->first();

      return view('about.us', compact('data'));
    }

  	public function editAbout()
    {
      $about = About::latest()->first();

      if(request()->input())
      {
        $about->body = request()->body;
        $about->save();

        return response()->json(['success' => true]);
      }

      return view('about.editabout', compact('about'));
    }
}