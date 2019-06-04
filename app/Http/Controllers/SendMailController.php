<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMailTo;
use App\User;
use App\SendMail;

class SendMailController extends Controller
{
    public function mailToUser()
    {
      $mail = request()->validate([
      	'subject'	=> 'required|min:5',
        'body'		=> 'required|min:15',
        'user_id'		=> 'required'
      ]);

      $user = User::findOrFail($mail['user_id']);

      SendMail::create($mail);

      \Mail::to($user->email)
        ->send(new SendMailTo($mail));


      return back()->with('success', 'email sent');
    }

  	public function mailToAllUser()
    {
      $mail = request()->validate([
      	'subject'	=> 'required|min:5',
        'body'		=> 'required|min:15',
      ]);

      set_time_limit(0);

      SendMail::create($mail);

      User::where('email', '!=', null)->chunk(200,  function($users) use ($mail) {

        foreach($users as $user)
      		dispatch(new \App\Jobs\SendEmail($user->email, $mail));
        }
      );

      return back()->with('success', 'email sent with queue');
    }

  	public function logMail()
    {
      return datatables()->of(SendMail::with('user')->orderBy('created_at', 'desc'))
        ->editColumn('user_id', function ($user) {
        	return $user->user->name ?? 'All Member';
        })
        ->addColumn('action', function ($user) {
        	return "<button class='btn btn-primary' onclick='baca({$user->id})'>baca</button>";
        })
        ->make(true);
    }

  	public function getLog($id)
    {
      $mail = SendMail::find($id);

      return $mail;
    }

  	public function hasEmail()
    {
      $users = User::where('name', 'like', '%'. request('q') . '%')->take(15)->get();

      return $users;
    }
}