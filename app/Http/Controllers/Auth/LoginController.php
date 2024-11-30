<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Google\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as TwoUser;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return redirect('/fb-login');
    }

    public function redirect()
    {
        return Socialite::driver('facebook')
            ->usingGraphVersion('v19.0')->redirect();
    }

    /*
    * redirect OAuth twitter
    */
    public function redirectTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /*
    * twitter callback
    */
    public function callbackTwitter()
    {
        $twitter = Socialite::driver('twitter')->user();

        $user = $this->findOrCreate('twitter_id', $twitter);

        return $this->accessProfile($user);
    }

    public function callbackGoogle()
    {
        $google = Socialite::driver('google')->user();

        $user = $this->findOrCreate('google_id', $google);

        return $this->accessProfile($user);
    }

    public function callback()
    {
        $facebook = Socialite::driver('facebook')->user();

        $user = $this->findOrCreate('provider_id', $facebook);

        return $this->accessProfile($user);
    }

    public function handleGoogleOneTap(Request $request)
    {
        try {
            $client = new Client([
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
            ]);

            $user = $client->verifyIdToken($request->credential);

            if ($user) {
                // Create a socialite-like object for compatibility with existing code
                $googleUser = (new TwoUser)->setRaw($user)->map([
                    'avatar' => Arr::get($user, 'picture'),
                    'email' => Arr::get($user, 'email'),
                    'email_verified' => Arr::get($user, 'email_verified'),
                    'host_domain' => Arr::get($user, 'hd'),
                    'id' => Arr::get($user, 'sub'),
                    'name' => Arr::get($user, 'name'),
                ]);

                $user = $this->findOrCreate('google_id', $googleUser);

                // return $this->accessProfile($user);
                return response()->json([
                    'success' => true,
                    'redirect_url' => $this->redirectTo,
                    'message' => 'Login successful'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid token'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication failed'
            ], 400);
        }
    }

    public function findOrCreate($auth, $social)
    {
        $user = $this->findSocialId($auth, $social);

        if (! $user) {
            $user = $this->createNewUser($auth, $social);
        }

        return $user;
    }

    protected function findSocialId($auth, $social)
    {
        $user = User::where($auth, $social->getId())->first();

        return $user;
    }

    /**
     * Create a new user from the given socialite user.
     *
     * @param  string  $auth
     * @param  \Laravel\Socialite\Contracts\User  $social
     * @return \App\User
     */
    protected function createNewUser($auth, $social)
    {
        $uname = $social->getName();

        $uname = explode(' ', $uname);
        $name = str_slug($uname[0]) . rand(000, 999);

        // Check if user exists with this email
        $existingUser = User::where('email', $social->getEmail())->first();
        if ($existingUser) {
            $existingUser->{$auth} = $social->getId();
            $existingUser->save();
            return $existingUser;
        }

        $user = new User;
        $user->{$auth} = $social->getId();
        $user->name = $social->getName();
        $user->email = $social->getEmail();
        $user->biodata = 'Saya pemain Toram!';
        $user->ign = '-';
        $user->username = $name;
        $user->gender = 'cowok';
        $user->alamat = 'Bumi, Indonesia';
        $user->link = $raw['link'] ?? '-';
        $user->avatar = $social->getAvatar();
        $user->save();

        return $user;
    }

    public function accessProfile($user)
    {
        if ($user->banned == 1) {
            return redirect('/')->with('gagal', 'Akun di banned!! hubungi admin untuk menindak lanjuti');
        }

        Auth::login($user, true);

        $user->historyLogin()->create([
            'ip' => request()->ip(),
            'browser' => request()->userAgent(),
            'extra' => 'Logged In!!',
        ]);

        return redirect($this->redirectTo);
    }

    public function devLogin()
    {
        // must be only in development
        if (! app()->isLocal()) {
            return $this->redirect();
        }

        // login as admin

        if (request()->has('user')) {
            $user = User::find(1326);
        } else {
            $user = User::find(1);
        }

        Auth::login($user, true);

        $user->historyLogin()->create([
            'ip' => request()->ip(),
            'browser' => request()->userAgent(),
            'extra' => 'Logged In as Development!!',
        ]);

        return redirect($this->redirectTo);
    }
}
