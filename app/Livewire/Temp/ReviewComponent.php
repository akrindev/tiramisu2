<?php

namespace App\Livewire\Temp;

use Livewire\Component;
use Livewire\Attributes\On;

class ReviewComponent extends Component
{
    public $component;

    public function mount()
    {
        $this->component = 'new_item';
    }

    public function render()
    {
        return view('livewire.temp.review-component');
    }

    #[On('component')]
    public function component($name = 'new_item')
    {
        $this->component = $name;
    }
}
