<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Emblem;
use App\EmblemList;

class EmblemController extends Controller
{
  public function index()
  {
    $emblems = Emblem::all();

    return view('emblem.index', compact('emblems'));
  }

  public function show($id)
  {
    $emblems = Emblem::findOrFail($id);

    return view('emblem.show', compact('emblems'));
  }
}