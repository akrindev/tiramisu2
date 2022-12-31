<?php

namespace App\Http\Livewire\Admin;

use App\Drop;
use Livewire\Component;
use Livewire\WithPagination;

class DropSee extends Component
{
    use WithPagination;

    public $type = 0;

    public $search;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['editItem', 'onCancel', 'saved', 'deleted'];

    public function editItem($id)
    {
        $data = Drop::findOrFail($id)->toArray();

        $this->emit('getData', $data);
    }

    public function saved($value = true)
    {
        session()->flash('saved', 'Item drop berhasil di update!');
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
