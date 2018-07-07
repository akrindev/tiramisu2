<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}