<?php

namespace App\Http\Livewire\Temp\Review;

use App\Element;
use App\Map;
use App\TempMonster;
use Livewire\Component;
use Livewire\WithPagination;

class NewMonster extends Component
{
    use WithPagination;

    protected $listeners = [
        'done',
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
        $monsters = TempMonster::with(['drops', 'element', 'user'])->latest()
            ->whereNull('monster_id')
            ->whereApproved(0)
            ->paginate();

        return view('livewire.temp.review.new-monster', [
            'monsters' => $monsters,
            'maps' => $maps,
            'elements' => $elements,
        ]);
    }
}
