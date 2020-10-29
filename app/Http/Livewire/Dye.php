<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App;
use App\MonthlyDye;

class Dye extends Component
{
    public function render()
    {
        $dyes = MonthlyDye::with([
            'monster', 'dye'
        ])->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get()
            ->sortBy('monster.name');

        $dyes->map(function($item) {

            if(App::isLocale('en')) {
                $item->monster->name = $item->monster->name_en;
            }

            $item->monster->name = explode('(', $item->monster->name)[0];

            return $item;
        });

        return view('livewire.dye', compact('dyes'));
    }

    public function switchLocalization($locale)
    {
        if(in_array($locale, ['en', 'id'])) {
            App::setLocale($locale);
        }
    }
}