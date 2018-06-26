<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Crysta;

class CariController extends Controller
{
    public function cari()
    {
      $key = request('key');
      $type = request('type');

      if($type == 'perlengkapan')
      {
        return $this->cariPerlengkapan($key);
      } else {
        return $this->cariCrysta($key);
      }
    }



    private function cariPerlengkapan($key)
    {
      $f = Barang::where('nama','LIKE', '%' . $key . '%')->get();

      if(! $f)
      {
        return back()->with('sukses','Tidak ditemukan');
      }

      return view('equip/equip',[
          'data' => $f
      ]);
    }


    private function cariCrysta($key)
    {
      $f = Crysta::where('nama', 'LIKE','%'.$key.'%')->get();

      if(! $f)
      {
        return back()->with('sukses','Tidak ditemukan');
      }

      return view('crysta/crysta',[
          'data' => $f
      ]);
    }
}