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
      $threads = Auth::user()->thread;

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
}