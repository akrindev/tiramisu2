<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XpController extends Controller
{
    public function index()
    {
      return view('xp_calculator');
    }
}