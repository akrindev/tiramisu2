<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App;
use App\Helpers\Level;

class Leveling extends Component
{
    public $level;
    public $bonusExp;
    public $range;

    public function mount($level, $bonusexp, $range)
    {
        $this->level = $level;
        $this->bonusExp = $bonusexp;
        $this->range = $range;
    }

    public function render()
    {
        $lvl = $this->level;
    	$bonusExp = $this->bonusExp;
    	$range = $this->range;

    	$min = $lvl-$range;
    	$max = $lvl+$range;

        $mobs = (new Level)->getListMons($lvl, $min, $max, $bonusExp);

        return view('livewire.leveling', compact('mobs'));
    }

    public function switchLocalization($locale)
    {
        if(in_array($locale, ['en', 'id'])) {
            App::setLocale($locale);
        }
    }
}