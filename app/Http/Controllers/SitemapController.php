<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogSearch;

class SitemapController extends Controller
{
  	public function show()
    {
      $searchTotal = LogSearch::count();
      $searches = LogSearch::distinct()->select('q')->paginate(250);

      return view('sitemap.unique_search', compact('searches', 'searchTotal'));
    }
}