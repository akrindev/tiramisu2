<?php

namespace App\Http\Livewire\Registled;

use Livewire\Component;
use Livewire\WithPagination;

use App\Drop;

class Show extends Component
{
	use WithPagination;

	public $paginationTheme = 'bootstrap';

    public function render()
    {
		$registleds = Drop::with('registled')->whereDropTypeId(64)->paginate(30);

        return view('livewire.registled.show', compact('registleds'));
    }
}
