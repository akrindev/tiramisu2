<?php

namespace App\Http\Livewire\Registled;

use App\Drop;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $query;

    protected $queryString = ['query'];

    public $paginationTheme = 'bootstrap';

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = $this->query;

        $registleds = Drop::whereDropTypeId(64)
            ->when(! is_null($query), function ($q) use ($query) {
                $q->where('name', 'like', '%'.$query.'%')
                    ->orWhere('name_en', 'like', '%'.$query.'%')
                    ->whereDropTypeId(64);
            })
            ->with('registled')
            ->paginate(30);

        return view('livewire.registled.show', compact('registleds'));
    }
}
