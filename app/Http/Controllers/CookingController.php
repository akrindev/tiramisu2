<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cooking;
use App\User;
use Image;
use Datatables;

class CookingController extends Controller
{
  public function index()
  {
    $cooks = Cooking::orderBy('level')->get();

    return view('cooking.home', compact('cooks'));
  }

  public function buff()
  {
    return datatables()->of(User::where('visibility', 1)->with('cooking')->orderBy('created_at', 'desc'))
      ->addColumn('oleh', function ($oleh){
        return "<div><strong class='mr-2 mb-2 text-center'>{$oleh->name}</strong><br><small class='text-muted'>ign: {$oleh->ign}</small></div>";
      })
      ->addColumn('buff', function ($buff) {
      	return "<div>{$buff->cooking->buff} {$buff->cooking->stat}</div><small class='text-muted'>level: {$buff->cooking_level}</small>";
      })
      ->addColumn('hubungi', function ($user) {
        $line = $user->contact->line != null ?
          '<a href="//line.me/ti/p/~'.$user->contact->line.'" class="btn btn-outline-success btn-sm mr-2"><i class="fa fa-commenting-o mr-1"></i> line</a>' : '';
        $wa =  $user->contact->whatsapp != null ?
          '<a href="//wa.me/'.$user->contact->whatsapp.'" class="btn btn-success btn-sm"><i class="fa fa-whatsapp mr-1"></i> whatsapp</a>' : '';

        return $line . $wa;
      })
      ->addColumn('bio', function ($bio) {
      	return $bio->biodata;
      })
      ->rawColumns(['oleh', 'buff', 'hubungi'])
      ->make(true);

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