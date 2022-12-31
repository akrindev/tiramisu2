<?php

namespace App\Http\Controllers;

use App\Http\Resources\SecretMessageCollection;
use App\SecretMessage;
use App\User;

class SecretMessageController extends Controller
{
    public function show(User $user)
    {
        if (request()->expectsJson()) {
            $secrets = SecretMessage::whereUserId($user->id)
                ->when(true, function ($query) {
                    $isOwnser = (auth()->check() && auth()->id() == $query->user_id) ? true : false;

                    if (! $isOwnser) {
                        return $query->publicMessage();
                    }
                })
                ->get();

            return new SecretMessageCollection($secrets);
        }

        return view('secrets.messages', compact('user'));
    }

    public function store()
    {
        $data = request()->validate([
            'user_id' => ['required', 'exists:users,id'],
            'message' => ['required', 'min:3', 'max:400'],
            'privacy' => ['required'],
        ]);

        $secret = SecretMessage::create($data);

        return response()->json($secret, 201);
    }

    public function reply()
    {
        $data = request()->validate([
            'user_id' => ['required', 'exists:users,id'],
            'message' => ['required', 'min:3', 'max:400'],
            'parent_id' => ['required'],
        ]);

        $secret = SecretMessage::create($data);

        return response()->json($secret, 201);
    }
}
