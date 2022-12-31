<?php

namespace App\Http\Livewire\Temp\Review;

use App\TempDrop;
use Livewire\Component;
use Livewire\WithPagination;

class UpdatedItem extends Component
{
    use WithPagination;

    protected $listeners = [
        'done',
    ];

    public function done($value)
    {
        $message = $value == 'updated' ? 'item telah di edit' : 'item di tolak';

        session()->flash('success', $message);
    }

    public function render()
    {
        $items = TempDrop::with('drop', 'user')->latest()
            ->whereNotNull('drop_id')
            ->whereApproved(0)
            ->paginate();

        return view('livewire.temp.review.updated-item', ['items' => $items]);
    }
}
