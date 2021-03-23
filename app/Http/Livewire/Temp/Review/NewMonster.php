<?php

namespace App\Http\Livewire\Temp\Review;

use Livewire\Component;
use Livewire\WithPagination;

use App\TempMonster;

class NewMonster extends Component
{
    use WithPagination;

    protected $listeners = [
        'done'
    ];

    public function done()
    {
        session()->flash('success', 'Data monster di tambahkan');
    }

    public function render()
    {
        $monsters = TempMonster::with(['drops', 'element'])->latest()->whereNull('monster_id')
                        ->whereApproved(0)
                        ->paginate();

        return view('livewire.temp.review.new-monster', [ 'monsters' => $monsters ]);
    }
}
