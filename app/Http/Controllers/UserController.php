<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
    * profile user if loged in
    *
    **/
 	public function profile($provider_id = false)
    {
      // jika provider_id kosong
      if($provider_id == false)
      {
        $profile = Auth::user();

        if( ! Auth::check())
        {
          session()->flash('gagal','Kamu belum login');
          return redirect('/');
        }
      }

      // jika provider_id ada

      $profile = User::where('provider_id',$provider_id)->first();

      //jika tidak ditemukan user dalam database
      if( ! $profile)
      {
		session()->flash('gagal','User tidak di temukan');
        return redirect('/');
      }

      return view('profile', compact('profile'));
    }
}