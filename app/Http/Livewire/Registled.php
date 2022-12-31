<?php

namespace App\Http\Livewire;

use App\Drop;
use Livewire\Component;
use Livewire\WithPagination;

class Registled extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $drops = Drop::with('dropType')->where('drop_type_id', 64)->paginate(50);

        return view('livewire.registled', compact('drops'));
    }
}
