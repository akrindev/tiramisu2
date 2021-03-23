<?php

namespace App\Http\Livewire\Temp\Review;

use Livewire\Component;
use Livewire\WithPagination;
use App\TempDrop;

class UpdatedItem extends Component
{
    use WithPagination;

    protected $listeners = [
        'done'
    ];

    public function done()
    {
        session()->flash('success', 'item telah di edit');
    }

    public function render()
    {
        $items = TempDrop::with('drop')->latest()
                        ->whereNotNull('drop_id')
                        ->whereApproved(0)
                        ->paginate();


        return view('livewire.temp.review.updated-item', [ 'items' => $items ]);
    }
}
