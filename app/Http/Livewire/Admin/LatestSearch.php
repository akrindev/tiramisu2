<?php

namespace App\Http\Livewire\Admin;

use App\LogSearch;
use Livewire\Component;
use Livewire\WithPagination;

class LatestSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searches = LogSearch::with('user')->latest()->paginate(10);

        return view('livewire.admin.latest-search', compact('searches'));
    }
}
