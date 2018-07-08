<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mob;
use Auth;
use Image;

class MobController extends Controller
{
    public function index()
    {
      $data = Mob::select('map','mapslug')->distinct()->get();


      return view('monster.index')->with('data', $data);
    }


    public function single($slug)
    {
      $mons = Mob::where('slug',$slug)->paginate(1);

      if( ! $mons)
      {
        return redirect('/')->with('gagal', 'Tidak di temukan');
      }

      return view('monster/mobs',[
          'data' => $mons
      ]);
    }

    public function peta($slug)
    {
      $mons = Mob::where('mapslug',$slug)->paginate(20);

      if(!$mons)
      {
        return redirect('/')->with('gagal', 'Tidak di temukan');
      }

      echo view('monster/mobs',[
          'data' => $mons,
          'dut' => 'ok'
      ]);
    }

  	public function add()
    {
		$this->needLogin();

      	return view('monster.add_mobs');
    }


    public function addPost(Request $request)
    {
      $this->needLogin();

      $data = [
          'nama' => e(ucfirst(request('nama'))),
          'slug' => str_slug(strtolower(request('nama'))).'-'.rand(000,999),
          'type' => e(request('type')),
          'element' => e(request('element')),
          'hp' => e(request('hp')),
          'xp' => e(request('xp')),
          'level' => e(request('level')),
          'map' => e(request('map')),
          'mapslug' => str_slug(strtolower(request('map'))),
          'kandang' => e(request('kandang')),
          'drop_items' => e(request('drop_items')),
          'drop_equip' => e(request('drop_equip')),
          'notes' => e(request('notes'))
      ];


      if(request('withimg') == "ya")
      {
          $pics = $this->pics();
          $dataa = [ 'pics' => $pics ];
          $data = array_merge($data,$dataa);
      }


      if(Mob::create($data))
      {
          return redirect('/')->with('sukses','Data Monster telah di tambahkan');
      }

    }


  // edit

  	public function edit($id)
    {
		$this->needLogin();

      	$data = Mob::find($id);

      	return view('monster.edit_mobs',$data);
          //->with('data',$data);
    }


    public function editPost(Request $request, $id)
    {
      $this->needLogin();

      $item = Mob::find($id);

      if( ! $item)
      {
        abort(404);
      }

      $data = [
          'nama' => e(ucfirst(request('nama'))),
          'slug' => str_slug(strtolower(request('nama'))).'-'.rand(000,999),
          'type' => e(request('type')),
          'element' => e(request('element')),
          'hp' => e(request('hp')),
          'xp' => e(request('xp')),
          'level' => e(request('level')),
          'map' => e(request('map')),
          'mapslug' => str_slug(strtolower(request('map'))),
          'kandang' => e(request('kandang')),
          'drop_items' => e(request('drop_items')),
          'drop_equip' => e(request('drop_equip')),
          'notes' => e(request('notes'))
      ];


      if(request('withimg') == "ya")
      {
          $pics = $this->pics();
          $dataa = [ 'pics' => $pics ];
          $data = array_merge($data,$dataa);
      }


      if($item->update($data))
      {
          return back()->with('sukses','Data Monster telah di ubah');
      }

    }

  	public function destroy()
    {
      $this->needLogin();

      $item = Mob::find(request('id'));

      $item->delete();

      return redirect('/')->with('sukses', 'Data mobs berhasil di hapus');
    }


    private function pics()
    {
      $urlimg = file_get_contents(request('pics'));
      $nama = 'imgs/mobs/'.str_slug(strtolower(request('nama'))).'-'.rand(00000,99999).'.png';

      file_put_contents($nama,$urlimg);


      $make = Image::make(public_path($nama));

      $make->text('(c) toram-id.info', 15, 10, function($font)
          {
              $font->size(24);
              $font->color('#ffffff');
              $font->align('left');
              $font->valign('bottom');
          });

      $make->save(public_path($nama));
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