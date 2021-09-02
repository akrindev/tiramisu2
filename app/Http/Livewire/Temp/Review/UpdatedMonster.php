<?php

namespace App\Http\Livewire\Temp\Review;

use Livewire\Component;
use Livewire\WithPagination;

use App\TempMonster;
use App\Map;
use App\Element;

class UpdatedMonster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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
        $monsters = TempMonster::with(['user', 'monster', 'drops'])->latest()->whereApproved(0)
            ->whereNotNull('monster_id')
            ->simplePaginate();

        return view('livewire.temp.review.updated-monster', [
            'monsters' => $monsters,
            'maps'     => $maps,
            'elements'  => $elements
        ]);
    }
}
