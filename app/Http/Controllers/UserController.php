<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Forum;
use Auth;
use DB;

class UserController extends Controller
{
    /**
    * profile user if loged in
    *
    **/
 	public function profileku()
    {
      $threads = Auth::user()->thread()->paginate(10);

      $z = Forum::where('user_id',auth()->id());

      return view('profile')->with('profile',Auth::user())
        ->with('threads',$threads);
    }

  	public function profile($provider_id)
    {
      $user = User::where('provider_id',$provider_id)->firstOrFail();

      if(auth()->check() && auth()->user()->provider_id == $provider_id)
      {
        	return $this->profileku();
      }

      $threads = $user->thread;

      return view("profile_user", [
      	'profile' => $user,
        'threads'	=> $threads
      ]);
    }

  public function notifikasi()
  {
    $notif = auth()->user()->notifications()->paginate(25);

    return view('auth.notifikasi',[
    	'data'	=>	$notif
    ]);
  }


  /**
  *
  * Setting
  */

  public function settingProfile()
  {
    return view('auth.setting_profile',[
    	'data'	=> auth()->user()
    ]);
  }

  public function settingProfileSubmit()
  {
    $user = User::findOrFail(auth()->id());

    request()->validate([
    	'username'	=> 'required|alpha_num|max:10',
      	'ign'	=> 'required',
      	'biodata'	=> 'required|max:160',
      	'alamat'	=>  'required|max:160',
      	'birthday'	=> 'date|nullable'
    ]);

    if(request()->username != $user->username && $user->changed == 0)
    {
      $user->username = request()->username;
      $user->changed = 1;
    }

    $user->email = request()->email;
    $user->ign = request()->ign;
    $user->biodata = request()->biodata;
    $user->alamat = request()->alamat;

    $user->save();

    return back()->with('sukses', 'Data telah di ubah!');
  }
}