<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Formula as WorkSpace;

class Formula extends Component
{
    use WithPagination;

    public $type;

	public $search;

	protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->type = 'all';
    }

    public function render()
    {
        $type = $this->type;
		$search = $this->search;

        $formulas = WorkSpace::with('users')->exclude('body')
            ->when($this->type != 'all', function ($query) use ($type) {
            	return $query->whereType($type);
            })
			->when($this->search != null, function ($query) use ($search) {
				return $query->where('note', 'like', '%'.$search.'%');
			})
            ->latest()->paginate(21);

        return view('livewire.formula', compact('formulas'));
    }

    public function formulaType($type)
    {
        $this->resetPage();

        if(in_array($type, ['all', 'a', 'w'])) {
            $this->type = $type;
        }
    }
}