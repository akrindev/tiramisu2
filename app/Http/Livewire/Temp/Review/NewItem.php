<?php

namespace App\Http\Livewire\Temp\Review;

use Livewire\Component;
use Livewire\WithPagination;

use App\TempDrop;

class NewItem extends Component
{
    use WithPagination;

    protected $listeners = [
        'done'
    ];

    public function done()
    {
        session()->flash('success', 'item telah di tambahkan');
    }

    public function render()
    {
        $items = TempDrop::latest()->whereNull('drop_id')
                    ->whereApproved(0)
                    ->paginate();

        return view('livewire.temp.review.new-item', [ 'items' => $items]);
    }
}
