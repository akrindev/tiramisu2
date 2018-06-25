<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Auth;
use DB;

class EquipController extends Controller
{
  public function equips($slug=false)
  {
    if($slug == false)
      return redirect('/');


    $kunci = Barang::where('typeslug',$slug)->get();

    if(!$kunci)
    {
      return redirect('/');
    }

    return view('equip.equip')->with('data',$kunci);
  }

  public function equip($slug=false)
  {
    if($slug == false)
      return redirect('/');


    $kunci = Barang::where('slug',$slug)->get();

    if(!$kunci)
    {
      return redirect('/');
    }

    return view('equip.equip')->with('data',$kunci);
  }

  public function edit($id)
  {
    $this->needLogin();

    $item = Barang::find($id);

    return view('equip.edit_equip')->with('data',$item);
  }


  public function editPost(Request $request, $id)
  {

    $this->needLogin();

    $data = Barang::find($id);

    if( ! $data)
    {
      return redirect('/');
    }

    $request->validate([
    	'nama' => 'required',
      	'type' => 'required',
		'pics' => 'nullable',
      	'stats' => 'nullable',
      	'drop' => 'nullable',
      	'blacksmith' => 'nullable',
      	'proc' => 'nullable',
      	'prod' => 'nullable'
   	]);


 	$post = [
    	'nama' => $request->nama,
      	'type' => $request->type,
      	'stats' => $request->stats ?? '-',
      	'drop' => $request->drop ?? '-',
      	'blacksmith' => $request->blacksmith ?? '-',
      	'proc' =>  $request->proc ?? '-',
      	'prod' => $request->prod ??'-'
    ];

    $po = [
      'slug' => str_slug(strtolower($request->nama))
    ];
    $result = array_merge($post,$po);

    if($request->gantipics == 'ya')
    {
      //unlink('/imgs/'. str_slug(strtolower($request->nama).'.png');
        $pics = $this->pics();
		$dataa = [ 'pics' => $pics ];
		$result = array_merge($result,$dataa);
    }


    if($data->update($result))
    {
      return redirect('/equip/'.str_slug(strtolower($request->nama)) ?? $data->slug)->with('upsukses','updated');
    }
  }


  public function tambah()
  {
    $this->needLogin();

    return view('equip/add_equip');
  }


  public function tambahPost(Request $request)
  {

    $this->needLogin();


    $request->validate([
    	'nama' => 'required',
      	'type' => 'required',
		'pics' => 'nullable',
      	'stats' => 'nullable',
      	'drop' => 'nullable',
      	'blacksmith' => 'nullable',
      	'proc' => 'nullable',
      	'prod' => 'nullable'
   	]);


    if($request->pics)
    {
      $pics = $this->pics();
    }


 	$post = [
    	'nama' => $request->nama,
      	'type' => $request->type,
      	'stats' => $request->stats ?? '-',
      	'drop' => $request->drop ?? '-',
      	'blacksmith' => $request->blacksmith ?? '-',
      	'quest'	=> $request->quest ?? '-',
      	'proc' =>  $request->proc ?? '-',
      	'prod' => $request->prod ??'-'
    ];


    $po = [
      'slug' =>  str_slug(strtolower($request->nama)),

      'typeslug' =>  str_slug(strtolower($request->type))
    ];
    $result = array_merge($post,$po);

    if($request->pics)
    {
      $pic = [ 'pics' => $pics ];
      $result = array_merge($result,$pic);
    }

    if(Barang::create($result))
    {
      return redirect('/equip/'.str_slug(strtolower($request->nama)) ?? $data->slug)->with('upsukses','updated');
    }
  }

  public function destroy(Request $request)
  {

    $this->needLogin();

    $item = Barang::find($request->id);
    $item->delete();

    session()->flash('sukses', 'Data berhasil dihapus');

    return redirect('/');

  }


  private function pics()
  {
    $urlimg = file_get_contents(request()->pics);
    $nama = 'imgs/'.str_slug(strtolower(request()->nama)).'.png';

    file_put_contents($nama,$urlimg);



    return $nama;
  }

  private function needLogin()
  {
    if(!Auth::check() && Auth::user()->role == 'member')
    {
      return redirect('/')->with('gagal','Tidak diijinkan');
    }
  }
}