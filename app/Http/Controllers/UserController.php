<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
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
      $threads = Auth::user()->thread()->latest()->paginate(10);

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

      $threads = $user->thread()->latest()->paginate(8);

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
    	'username'	=> 'required|alpha_num|max:10|unique:users,username,'.$user->id,
      	'ign'	=> 'required',
      	'biodata'	=> 'required|max:160',
      	'alamat'	=>  'required|max:160',
      	'birthday'	=> 'date|nullable'
    ]);

    $gender = request()->gender;

    switch($gender)
    {
      case 1:
        $gen = "cowok";
        break;
      case 2:
        $gen = "cewek";
          break;
      default:
        $gen= 'hode';
        break;
    }

    if(request()->username != $user->username && $user->changed == 0)
    {
      $user->username = request()->username;
      $user->changed = 1;
    }

    $user->email = request()->email;
    $user->ign = request()->ign;
    $user->biodata = request()->biodata;
    $user->alamat = request()->alamat;
    $user->gender = $gen;

    $user->save();

    return back()->with('sukses', 'Data telah di ubah!');
  }

  	public function saveContact()
    {
      request()->validate([
      	'line' => 'required',
        'whatsapp' => 'required|numeric'
      ]);

      $contact = Contact::find(auth()->id());
      $con = new Contact;

      if(!$contact)
      {
        $con->user_id	= auth()->id();
        $con->line = request()->line;
        $con->whatsapp = request()->whatsapp;
        $con->save();
      } else {
        $contact->line = request()->line;
        $contact->whatsapp = request()->whatsapp;
        $contact->save();
      }

      return redirect('/shop/jual');
    }
}