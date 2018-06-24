<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


  	public function redirect()
    {
      return Socialite::driver('facebook')->redirect();
    }

  	public function callback()
    {
      $facebook = Socialite::driver('facebook')->user();

      $user = $this->findOrCreate($facebook);

      Auth::login($user, true);

      return redirect($this->redirectTo);

    }

  	public function findOrCreate($facebook)
    {
      $user = User::where('provider_id',$facebook->getId())->first();

      $raw = $facebook->getRaw();

      if( ! $user)
      {
        $user = new User;
        $user->provider_id = $facebook->getId();
        $user->name = $facebook->getName();
        $user->email = $facebook->getEmail();
        $user->biodata = 'Saya pemain Toram!';
        $user->ign = '-';
        $user->username = '-';
        $user->alamat = 'Bumi, Indonesia';
        $user->link = $raw['link'] ?? '-';
        $user->save();
      }

      return $user;
    }


}