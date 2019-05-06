<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fill_stat;
use DB;
use Auth;

class FillController extends Controller
{

  	public function calculator()
    {
      return view('fillstats.calculator');
    }

    public function index()
    {
      $data = Fill_stat::get()->sortBy('plus')
        					  ->sortBy('type');

      $fills = Fill_stat::select(['type','plus'])->distinct()->get()
        ->sortBy('plus')
        ->sortBy('type');

      return view('fillstats.home', compact('data','fills'));
    }


    public function single($type,$plus=false)
    {
	  /**
      $tipe = $type == 'Armor' ? 1 : 2;

      if($plus == false){
          $data = Fill_stat::where('type',$tipe)->get();
      } else {
          $data = Fill_stat::where('type',$tipe)->get();
      }

      $data = collect($data)->sortBy('type')->sortBy('plus');

      return view('fillstats/home',[
          'data' => $data
      ]);
	  */
	  return $this->index();
    }

  	public function add()
    {
      $this->needLogin();

      return view('fillstats.add');
    }


  function addPost(Request $request)
  {
    $this->needLogin();

    $request->validate([
    	'type' => 'required',
      	'plus' => 'required',
      	'stats' => 'required',
      	'steps' => 'required'
    ]);

    if(Fill_stat::create($request->except('_token')))
    {
      return redirect()->back()->with('sukses','data telah di tambahkan');
    }
  }

  	public function edit($id)
    {
      $this->needLogin();

      $item = Fill_stat::find($id);

      if( ! $item)
      {
        return redirect('/')->with('gagal','gak di temukan');
      }

      return view('fillstats.edit')->with('data',$item);
    }

  	public function editPost(Request $request, $id)
    {
      $this->needLogin();

      $item = Fill_stat::find($id);

      if( ! $item)
      {
        return redirect('/')->with('gagal','gak di temukan');
      }

      $request->validate([
    	'type' => 'required',
      	'plus' => 'required',
      	'stats' => 'required',
      	'steps' => 'required'
      ]);

      if($item->update($request->except('_token')))
      {
      	return redirect()->back()->with('sukses','Data berhasil di ubah');
      }
    }

  	public function destroy()
    {
      $this->needLogin();

      $item = Fill_stat::find(request('id'));

      if( ! $item)
      {
        abort(404);
      }

      $item->delete();

      return redirect('/')->with('sukses', 'Data fill stats telah di hapus');
    }

    private function needLogin()
    {
      if(!Auth::check() && Auth::user()->role == 'member')
      {
        return redirect('/')->with('gagal','Tidak diijinkan');
      }
    }
}