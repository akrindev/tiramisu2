<?php

namespace App\Http\Livewire\Token;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public function generateNewToken()
    {
        if (Auth::user()->tokens()->where('name', 'api-access')->count() >= 1) {
            return;
        }

        $plain = Auth::user()->createToken('api-access', ['req:api'])->plainTextToken;

        Auth::user()->tokens()->where('name', 'api-access')->update([
            'plain_token' => $plain,
        ]);
    }

    public function getTokenProperty()
    {
        return Auth::user()->tokens()->where('name', 'api-access')->first();
    }

    public function render()
    {
        return view('livewire.token.show');
    }
}
