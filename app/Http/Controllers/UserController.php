<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contact;
use App\Forum;
use App\Fcm;
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

        return view('profile')->with('profile', Auth::user())
            ->with('threads', $threads);
    }

    public function profile($provider_id)
    {
        $user = User::where('provider_id', $provider_id)->firstOrFail();

        if (auth()->check() && auth()->user()->provider_id == $provider_id) {
            return $this->profileku();
        }

        $threads = $user->thread()->latest()->paginate(8);

        return view("profile_user", [
            'profile' => $user,
            'threads'    => $threads
        ]);
    }

    public function notifikasi()
    {
        $notif = auth()->user()->notifications()->paginate(25);

        return view('auth.notifikasi', [
            'data'    =>    $notif
        ]);
    }


    /**
     *
     * Setting
     */

    public function settingProfile()
    {
        return view('auth.setting_profile', [
            'data'    => auth()->user()
        ]);
    }

    public function settingProfileSubmit()
    {
        $user = User::findOrFail(auth()->id());

        request()->validate([
            'username'    => 'required|alpha_num|max:10|unique:users,username,' . $user->id,
            'ign'    => 'required',
            'email'        => 'email',
            'biodata'    => 'required|max:180',
            'alamat'    => 'required|max:160',
            'cooking'    => 'nullable|integer|max:38',
            'cooklv'    => 'nullable|integer|max:10',
            'second_cooking'    => 'nullable|integer|max:38',
            'second_cooklv'    => 'nullable|integer|max:10'
        ]);

        $gender = request()->gender;

        switch ($gender) {
            case 1:
                $gen = "cowok";
                break;
            case 2:
                $gen = "cewek";
                break;
            default:
                $gen = 'hode';
                break;
        }

        if (request()->username != $user->username && $user->changed == 0) {
            $user->username = request()->username;
            $user->changed = 1;
        }

        $user->email = request()->email;
        $user->ign = request()->ign;
        $user->biodata = request()->biodata;
        $user->alamat = request()->alamat;
        $user->gender = $gen;

        if (request('cooking') && request('cooklv') != null) {
            $user->cooking_id = request()->cooking;
            $user->cooking_level = request()->cooklv;
        }

        if (request('second_cooking') && request('second_cooklv') != null) {
            $user->second_cooking_id = request()->second_cooking;
            $user->second_cooking_level = request()->second_cooklv;
        }

        $user->visibility = request()->visibility;
        $user->subscribe = request('subscribe');

        $user->save();

        return back()->with('sukses', 'Data telah di ubah!');
    }

    public function saveContact()
    {
        request()->validate([
            'whatsapp' => 'max:15'
        ]);

        Contact::updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'line'    => request('line'),
            'whatsapp'    => request('whatsapp'),
            'facebook'  => request('facebook'),
            'twitter' => request('twitter')
        ]);

        return back()->with('c-sukses', 'data telah di simpan!!');
    }

    public function sendToken()
    {
        if (!auth()->check()) {
            return response()->json(["success" => false]);
        }

        Fcm::updateOrCreate([
            'user_id'    => auth()->id()
        ], [
            'token'    => request()->token
        ]);

        return response()->json(["success" => true]);
    }

    /*
    * User deletion account
    */
    public function deleteAccount(Request $request)
    {

        // temp delete account
        $request->user()->update([
            'provider_id'   => null,
            'twitter_id'    => null,
            'name'          => '[deleted account]',
            'email'        => 'null',
        ]);

        Auth::logout();

        // revalidate session
        $request->session()->invalidate();

        session()->flash('sukses', 'Your account has been deleted permanently!');

        return redirect('/');
    }

    public function confirmDeletionAccount($code)
    {
        $user = User::where('deletion_code', $code)->firstOrFail();

        if ($user->provider_id == null) {
            return response()->json([
                'status'    => 'This account has been deleted'
            ]);
        }

        Auth::login($user);

        return view('auth.account-deletion', compact('user'));
    }

    public function requestDeletionAccount()
    {
        $signed_request = request('signed_request');

        $data = $this->parse_signed_request($signed_request);
        $user_id = $data['user_id'];

        $user = User::where('provider_id', $user_id)->firstOrFail();

        $user->update([
            'deletion_code' => str_random(10)
        ]);

        $status_url =  route('user.account.deletion', ['code' => $user->deletion_code]); // URL to track the deletion

        $data = [
            'url' => $status_url,
            'confirmation_code' => $user->deletion_code
        ];

        return response()->json($data);
    }

    public function parse_signed_request($signed_request)
    {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = config('services.facebook.client_secret'); // Use your app secret here

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    private function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}
