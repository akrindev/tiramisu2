<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Cooking;
use App\User;
use Image;
use Datatables;

class CookingController extends Controller
{
  /*
  public function index()
  {
    $cooks = Cooking::orderBy('level')->get();

    return view('cooking.home', compact('cooks'));
  }
  */

  public function buff()
  {
    return datatables()->of(User::select('id', 'name', 'ign', 'biodata', 'cooking_id', 'cooking_level')->where('visibility', 1)->with('cooking', 'contact')->orderBy('updated_at', 'desc'))
      ->addColumn('oleh', function ($oleh){
        return "<div style='font-size:13px'><strong class='mr-2 mb-2 text-center'>{$oleh->name}</strong><br><small class='text-muted'>ign: {$oleh->ign}</small></div>";
      })
      ->addColumn('buff', function ($buff) {
      	return "<div style='font-size:13px'>{$this->getStatLv($buff->cooking->buff, $buff->cooking->stat, $buff->cooking_level)}</div><small class='text-muted'>level: {$buff->cooking_level}</small>";
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


  private function getStatLv($buff, $stat, $lv) {
    $out = 0;
    for($i = 1;$i <= $lv;$i++){
      if($i <= 5) {
        $out += $stat;
      } else {
        $out = $out+$this->getPoint($stat);
      }
    }

    return $this->parse($buff, $out);
  }


  private function getPoint($stat){

    $out = $stat;

    switch($stat) {
      case 2:
        $out = 4;
        break;
      case 4:
        $out = 6;
        break;
      case 6:
        $out = 14;
        break;
      case 400:
        $out = 600;
        break;
      case 20:
        $out = 40;
        break;
      default:
        $out = $stat;
    }

    return $out;
  }

  private function parse($buff, $out)
  {
    if(Str::contains($buff, '%')) {
      $replaced = Str::replaceLast('%', '', $buff);

      return $replaced . ' ' . $out . '%';
    }

    return $buff . ' ' . $out;
  }

  /*
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
  */
  /*
  public function delete($id)
  {
    $c = Cooking::findOrFail($id);
    $c->delete();

    return redirect('/cooking')->with('deleted', 'Data telah di hapus!!');
  }
  */
}