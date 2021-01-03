<?php

namespace App\Http\Livewire\Admin;

use App\Drop;
use App\DropType;

use Livewire\Component;
use Livewire\WithPagination;

class DropSee extends Component
{
    use WithPagination;

    //public $items;


    public $type = 0;

    public $search;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $items = $this->showDrops();

        return view('livewire.admin.drop-see', compact('items'));
    }

    public function showDrops()
    {
        $items = Drop::when($this->type != 0, function ($query) {
            $query->whereDropTypeId($this->type);
        })->when(\strlen($this->search) > 2, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('name_en', 'like', '%' . $this->search . '%');
        })
        ->orderByDesc('id')->paginate(10);

        $items->map(fn ($item) => $item);

        return $items;
    }

    public function updatingType()
    {
        $this->resetPage();
    }
}
