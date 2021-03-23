<?php

namespace App\Http\Livewire\Temp;

use Livewire\Component;

class ReviewComponent extends Component
{
    public $component;

    protected $listeners = [
        'component'
    ];

    public function mount()
    {
        $this->component = 'new_item';
    }

    public function render()
    {
        return view('livewire.temp.review-component');
    }

    public function component($name = 'new_item')
    {
        $this->component = $name;
    }
}
