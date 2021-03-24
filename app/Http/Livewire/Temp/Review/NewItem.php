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

    public function done($value)
    {
        $message = $value == 'added' ? 'item telah di tambahkan' : 'item di tolak';

        session()->flash('success', $message);
    }

    public function render()
    {
        $items = TempDrop::latest()->whereNull('drop_id')
                    ->whereApproved(0)
                    ->paginate();

        return view('livewire.temp.review.new-item', [ 'items' => $items ]);
    }
}
