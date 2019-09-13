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
      return view('fillstats.sb-admin.add');
    }


  function addPost(Request $request)
  {
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
      $data = Fill_stat::findOrFail($id);

      return view('fillstats.edit', compact('data'));
    }

  	public function editPost(Request $request, $id)
    {
      $item = Fill_stat::findOrFail($id);

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
      $item = Fill_stat::findOrFail(request('id'));
      $item->delete();

      return redirect('/')->with('sukses', 'Data fill stats telah di hapus');
    }
}