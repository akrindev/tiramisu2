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
            'monster' => function($query) {
                $query->with('map');
            }, 'dye'
        ])->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get()
            ->sortBy('monster.name');

        $dyes->map(function($item) {

            $item->monster->name = explode('(', $item->monster->name)[0];
            $item->monster->name_en = explode('(', $item->monster->name_en)[0];
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