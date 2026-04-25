<?php

namespace App\Livewire\Admin;

use App\Drop;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DropSee extends Component
{
    use WithPagination;

    public $type = 0;

    public $search;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    #[On('editItem')]
    public function editItem($id)
    {
        $data = Drop::findOrFail($id)->toArray();

        $this->dispatch('getData', $data);
    }

    #[On('saved')]
    public function saved($value = true)
    {
        session()->flash('saved', 'Item drop berhasil di update!');
    }

    #[On('onCancel')]
    public function onCancel()
    {
        //
    }

    #[On('deleted')]
    public function deleted()
    {
        //
    }

    public function render()
    {
        return view('livewire.admin.drop-see', [
            'items' => $this->showDrops(),
        ]);
    }

    public function showDrops()
    {
        $items = Drop::when($this->type != 0, function ($query) {
            $query->whereDropTypeId($this->type);
        })->when(\strlen($this->search) > 2, function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('name_en', 'like', '%'.$this->search.'%');
        })
        ->orderByDesc('id')->paginate(10);

        return $items;
    }

    public function updatingType()
    {
        $this->resetPage();
    }
}
