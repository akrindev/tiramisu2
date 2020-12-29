<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchForm extends Component
{
    public $q;
    public $type;

    protected $queryString = ['q', 'type'];

    protected $rules = [
    	'q'	=> 'required|min:3'
    ];

    protected $messages = [
    	'q.min'	=> 'The Search must be at least :min characters'
    ];

    public function mount($q)
    {
        $this->q = $q;
        $this->type = 'name_only';
    }

    public function render()
    {
        return view('livewire.search-form');
    }

    public function submit()
    {
        $this->validate();

        $this->emit('getResult', [$this->q, $this->type]);
    }

    public function hydrate()
    {
        $this->resetValidation();
    }
}