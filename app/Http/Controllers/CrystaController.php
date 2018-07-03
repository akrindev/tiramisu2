<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crysta;
use Auth;

class CrystaController extends Controller
{

  public function crystas($slug=false)
  {
    if($slug == false)
    {
      return redirect('/');
    }

    $crysta = Crysta::where('typeslug',$slug)->paginate(20);

    if( ! $crysta)
    {
      return redirect('/');
    }

    return view('crysta.crysta')->with('data',$crysta);
  }

  public function crysta($slug=false)
  {
    if($slug == false)
    {
      return redirect('/');
    }

    $crysta = Crysta::where('slug',$slug)->paginate(1);

    if( ! $crysta)
    {
      return redirect('/');
    }

    return view('crysta.crysta')->with('data',$crysta);
  }

  public function edit($id)
  {
    $item = Crysta::find($id);

    if( ! $item)
    {
      session()->flash('gagal', 'tidak di temukan');
      return redirect('/');
    }

    return view('crysta.edit_crysta')->with('data',$item);
  }

  public function editPost(Request $request, $id)
  {

    $this->needLogin();

    $data = Crysta::find($id);

    if( ! $data)
    {
      return redirect('/');
    }

    $request->validate([
    	'nama' => 'required',
      	'type' => 'required',

    ]);

    $result = [
      'nama' => $request->nama,
      'slug' => $request->slug ?? str_slug(strtolower($request->nama)),
      'type' => $request->type,
      'stats' => $request->stats ?? '-'
    ];

    if($data->update($result))
    {
      return redirect()->back()->with('sukses','updated');
    }
  }

  public function tambah()
  {
    $this->needLogin();

    return view('crysta.add_crysta');
  }


  public function tambahPost(Request $request)
  {

    $this->needLogin();

    $request->validate([
    	'nama' => 'required',
      	'type' => 'required'
    ]);

    $post = [
    	'nama' => e($request->input('nama')),
      	'type' => e($request->input('type')),
      	'stats' => e($request->input('stats'))
    ];

    $po = [
      'slug' => str_slug(strtolower($request->input('nama'))),

      'typeslug' => str_slug(strtolower($request->input('type')))
    ];
    $result = array_merge($post,$po);

    if(Crysta::create($result))
    {
      return redirect('/')->with('sukses','Data crysta telah ditambahkan!!');
    }
  }


  public function destroy(Request $request)
  {
    $this->needLogin();

    $item = Crysta::find($request->id);
    $item->delete();
    session()->flash('sukses','Data crysta dihapus');
    return redirect('/');
  }

  private function needLogin()
  {
    if(!Auth::check() && Auth::user()->role == 'member')
    {
      return redirect('/')->with('gagal','Tidak diijinkan');
    }
  }
}