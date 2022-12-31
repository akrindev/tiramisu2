<?php

namespace App\Http\Controllers;

use App\Mail\SendMailTo;
use App\SendMail;
use App\User;

class SendMailController extends Controller
{
    /**
     * mailToUser
     *
     * @return void
     */
    public function mailToUser()
    {
        $mail = request()->validate([
            'subject' => 'required|min:5',
            'body' => 'required|min:15',
            'user_id' => 'required',
        ]);

        $user = User::findOrFail($mail['user_id']);

        SendMail::create($mail);

        \Mail::to($user->email)
            ->send(new SendMailTo($mail));

        return back()->with('success', 'email sent');
    }

    /**
     * mailToAllUser
     *
     * @return void
     */
    public function mailToAllUser()
    {
        $mail = request()->validate([
            'subject' => 'required|min:5',
            'body' => 'required|min:15',
        ]);

        set_time_limit(0);

        SendMail::create($mail);

        $users = User::select(['email', 'subscribe'])->where('email', '!=', null)
            ->where('subscribe', '!=', 0)->get();

        $delay = 2;

        foreach ($users as $user) {
            dispatch(new \App\Jobs\SendEmail($user->email, $mail))->delay(now()->addMinutes($delay));
            $delay += 2;
        }

        return back()->with('success', 'email sent with queue');
    }

    /**
     * logMail
     *
     * @return void
     */
    public function logMail()
    {
        return datatables()->of(SendMail::with('user')->orderBy('created_at', 'desc'))
            ->editColumn('user_id', function ($user) {
                return $user->user->name ?? 'All Member';
            })
            ->editColumn('subject', function ($s) {
                return str_limit($s->subject);
            })
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d M Y');
            })
            ->addColumn('action', function ($user) {
                return "<button class='btn btn-primary' onclick='baca({$user->id})'>baca</button>";
            })
            ->rawColumns(['created_at', 'action'])
            ->make(true);
    }

    /**
     * getLog
     *
     * @param  mixed  $id
     * @return void
     */
    public function getLog($id)
    {
        $mail = SendMail::find($id);

        return response()->json($mail, 200);
    }

    public function hasEmail()
    {
        $users = User::where('name', 'like', '%'.request('q').'%')->take(15)->get();

        return $users;
    }
}
