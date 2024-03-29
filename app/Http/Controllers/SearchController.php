<?php

namespace App\Http\Controllers;

use App\Setting;

class SearchController extends Controller
{
    /**
     * search
     *
     * @return void
     */
    public function search()
    {
        $q = request()->q;
        $q = preg_replace('/\/$/', '$1', $q);

        $badword = Setting::first();
        $badword = explode(',', $badword->body['badword']);

        if (strlen($q) < 2) {
            return redirect('/')->with('gagal', 'Mencari harus memiliki 2 karakter atau lebih');
        }

        if (in_array(strtolower($q), $badword)) {
            return redirect('/')->with('gagal', 'Memblokir kata tak pantas');
        }

        return view('monster.search', compact('q'));
    }
}
