<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Formula as WorkSpace;

class CardFormula extends Component
{

    public $formula;

    public function mount($formula)
    {
        $this->formula = $formula;
    }

	public function show($id)
	{
		$data = WorkSpace::findOrFail($id);

		session()->flash('data', $data);
		return redirect('/fill_stats/simulator');
	}

    public function save($id)
    {
        $formula = WorkSpace::findOrFail($id);

        if(auth()->check () && ! $formula->users()->find(auth()->id())) {
            $formula->users()->attach(auth()->id());
        } else {
			session()->flash('fail', 'you are not login!!');
		}

        $this->formula = $formula;
    }

    public function render()
    {
        return view('livewire.card-formula');
    }
}