<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DropShow extends Component
{
    public $item;

    public function mount($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.admin.drop-show');
    }
}
