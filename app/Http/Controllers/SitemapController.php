<?php

namespace App\Http\Controllers;

use App\LogSearch;

class SitemapController extends Controller
{
    public function show()
    {
        $searchTotal = LogSearch::count();
        $searches = LogSearch::latest()->select('q')->paginate(250);

        return view('sitemap.latest_search', compact('searches', 'searchTotal'));
    }
}
