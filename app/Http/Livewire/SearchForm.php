<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Setting;

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
		$this->noBadwords();

        return view('livewire.search-form');
    }

    public function submit()
    {
        $this->validate();

        $this->emit('getResult', [$this->q, $this->type]);
    }

	public function noBadwords()
	{
    	$badwords = Setting::first();
    	$badwords = explode(',', $badwords->body['badword']);

		if(in_array(strtolower($this->q), $badwords)) {
			session()->flash('gagal', 'terdapat kata tak pantas!');
			return redirect()->to('/');
		}
	}

    public function hydrate()
    {
        $this->resetValidation();
    }
}