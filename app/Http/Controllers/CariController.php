<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Crysta;
use App\Mob;
use Illuminate\Http\Request;

class CariController extends Controller
{
    public function cari()
    {
        $key = request('key');
        $type = request('type');

        if ($type == '' && $key == '') {
            return redirect('/')->with('gagal', 'Ups!! cari apa?');
        }
        //      dd(request()->input());
        switch ($type) {
            case 'perlengkapan':
                return $this->cariPerlengkapan($key);
                break;
            case 'crysta':
                return $this->cariCrysta($key);
                break;
            case 'mons':
                return $this->cariItems($key);
                break;
            default:
                return back()->with('gagal', 'terjadi kesalahan');
        }
    }

    private function cariPerlengkapan($key)
    {
        $f = Barang::where('nama', 'LIKE', '%'.$key.'%')->paginate(30);

        if (! $f) {
            return back()->with('sukses', 'Tidak ditemukan');
        }

        return view('equip/equip', [
            'data' => $f,
        ]);
    }

    private function cariCrysta($key)
    {
        $f = Crysta::where('nama', 'LIKE', '%'.$key.'%')->paginate(30);

        if (! $f) {
            return back()->with('sukses', 'Tidak ditemukan');
        }

        return view('crysta/crysta', [
            'data' => $f,
        ]);
    }

    private function cariItems($key)
    {
        $k = Mob::where('nama', 'like', '%'.$key.'%')
            ->orWhere('drop_items', 'like', '%'.$key.'%')
            ->orWhere('drop_equip', 'like', '%'.$key.'%')
            ->orWhere('notes', 'like', '%'.$key.'%')
            ->paginate(20);

        return view('monster.mobs', [
            'data' => $k,
        ]);
    }
}
