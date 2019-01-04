<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cooking;
use Image;

class CookingController extends Controller
{
  public function index()
  {
    $cooks = Cooking::orderByDesc('level')->get();

    return view('cooking.home', compact('cooks'));
  }

  public function store()
  {
      $file = request()->file('icon')->getRealPath();

      $nama = '/img/cooking/'.str_slug(strtolower(request('nama'))).'-'.rand(00000,99999).'.png';

      $make = Image::make($file);
      $make->resize(100, 100);
      $make->save(public_path($nama));

      $picture = $nama;

      $cook = Cooking::create([
          'name'	=> request('nama'),
          'level'	=> request('level'),
          'buff'	=> request('buff'),
          'pt'		=> request('pt'),
          'picture'	=> $picture
      ]);

      return response()->json(['success' => true]);
  }

  public function delete($id)
  {
    $c = Cooking::findOrFail($id);
    $c->delete();

    return redirect('/cooking')->with('deleted', 'Data telah di hapus!!');
  }
}