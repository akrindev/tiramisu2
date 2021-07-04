<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SecretMessageController extends Controller
{
    public function show(User $user)
    {
        return view('secrets.messages', compact('user'));
    }
}
