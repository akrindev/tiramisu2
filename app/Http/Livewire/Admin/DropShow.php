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

    public function edit()
    {
        $this->emitUp('editItem', $this->item->id);
    }

    public function render()
    {
        return view('livewire.admin.drop-show');
    }
}
