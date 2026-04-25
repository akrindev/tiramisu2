<?php

namespace App\Livewire;

use Livewire\Component;

class FoodCard extends Component
{
    public $food;

    public function mount($food)
    {
        $this->food = $food;
    }

    public function render()
    {
        return view('livewire.food-card');
    }
}
