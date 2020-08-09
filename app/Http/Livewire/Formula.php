<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Formula as WorkSpace;

class Formula extends Component
{
    use WithPagination;

    public function render()
    {
        $formulas = WorkSpace::exclude('body')
            ->latest()->paginate(21);

        return view('livewire.formula', compact('formulas'));
    }

    public function show($id)
    {
        request()->session()->flash('data', $id);

        return redirect('/fill_stats/calculator');
    }
}