<?php

namespace App\Livewire\Temp\Review;

use App\TempDrop;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class NewItem extends Component
{
    use WithPagination;

    #[On('done')]
    public function done($value)
    {
        $message = $value == 'added' ? 'item telah di tambahkan' : 'item di tolak';

        session()->flash('success', $message);
    }

    public function render()
    {
        $items = TempDrop::with('drop', 'user')->latest()->whereNull('drop_id')
            ->whereApproved(0)
            ->paginate();

        return view('livewire.temp.review.new-item', ['items' => $items]);
    }
}
