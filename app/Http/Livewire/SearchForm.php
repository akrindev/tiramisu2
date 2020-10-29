<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\LogSearch;

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
    }

    public function render()
    {
        return view('livewire.search-form');
    }

    public function submit()
    {
        $this->validate();

        LogSearch::create([
            'user_id'	=> auth()->id() ?? null,
            'q'			=> $this->q
        ]);

        $this->emit('getResult', $this->q);
    }

    public function hydrate()
    {
        $this->resetValidation();
    }
}