<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Formula as WorkSpace;

class Formula extends Component
{
    use WithPagination;

    public $type;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->type = 'all';
    }

    public function render()
    {
        $type = $this->type;

        $formulas = WorkSpace::with('users')->exclude('body')
            ->when($this->type != 'all', function ($query) use ($type) {
            	return $query->whereType($type);
            })
            ->latest()->paginate(21);

        return view('livewire.formula', compact('formulas'));
    }

    public function save($id)
    {
        $formula = WorkSpace::find($id);
        
        auth()->user()->savedFormulas()->attach($formula);
    }

    public function formulaType($type)
    {
        $this->resetPage();

        if(in_array($type, ['all', 'a', 'w'])) {
            $this->type = $type;
        }
    }
}