<?php

namespace App\Http\Livewire\Temp\Review;

use Livewire\Component;
use Livewire\WithPagination;

use App\TempMonster;
use App\Map;
use App\Element;

class NewMonster extends Component
{
    use WithPagination;

    protected $listeners = [
        'done'
    ];

    public function done($value)
    {
        $message = $value == 'added' ? 'Data monster di tambahkan' : 'Data monster di tolak';

        session()->flash('success', $message);
    }

    public function render()
    {
        $maps = Map::get();
        $elements = Element::get();
        $monsters = TempMonster::with(['drops', 'element', 'user', 'map'])->latest()
            ->whereNull('monster_id')
            ->whereApproved(0)
            ->paginate();

        return view('livewire.temp.review.new-monster', [
            'monsters' => $monsters,
            'maps'      => $maps,
            'elements'  => $elements
        ]);
    }
}
