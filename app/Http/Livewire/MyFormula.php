<?php

namespace App\Http\Livewire;

use App\Formula as WorkSpace;
use Livewire\Component;
use Livewire\WithPagination;

class MyFormula extends Component
{
    use WithPagination;

    public $type;

    public $ctype;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->type = 'all';
        $this->ctype = 's';
    }

    public function render()
    {
        $type = $this->type;

        if ($this->ctype == 's') {
            $formulas = WorkSpace::with('users')->whereUserId(auth()->id())->exclude('body')
                ->when($this->type != 'all', function ($query) use ($type) {
                    return $query->whereType($type);
                })
                ->latest()->paginate(21);
        } else {
            $formulas = auth()->user()->savedFormulas()->with('users')
                ->when($this->type != 'all', function ($query) use ($type) {
                    return $query->whereType($type);
                })
                ->latest()->paginate(21);
        }

        return view('livewire.my-formula', compact('formulas'));
    }

    public function changeType($ctype)
    {
        $this->ctype = $ctype;
    }

    public function save($id)
    {
        $formula = WorkSpace::find($id);

        auth()->user()->savedFormulas()->attach($formula);
    }

    public function formulaType($type)
    {
        $this->resetPage();

        if (in_array($type, ['all', 'a', 'w'])) {
            $this->type = $type;
        }
    }
}
