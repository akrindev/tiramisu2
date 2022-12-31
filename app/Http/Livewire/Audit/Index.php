<?php

namespace App\Http\Livewire\Audit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class Index extends Component
{
    use WithPagination;

    public $eventType;

    public $auditType;

    public $queryString = [
        'eventType', 'auditType',
    ];

    protected $paginationView = 'bootstrap';

    public function getAuditsProperty()
    {
        return Audit::with(['auditable', 'user'])
            ->when(! is_null($this->eventType) && $this->eventType != 'all', function ($query) {
                $query->whereEvent($this->eventType);
            })
            ->when(! is_null($this->auditType) && $this->auditType != 'all', function ($query) {
                $query->where('auditable_type', $this->auditType);
            })
            ->latest()->simplePaginate();
    }

    public function getAuditableTypeProperty()
    {
        return DB::table('audits')->selectRaw('distinct(auditable_type)')->get();
    }

    public function render()
    {
        return view('livewire.audit.index')->extends('layouts.sb-admin');
    }
}
