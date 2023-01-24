<div class="p-3">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">System Audit</h1>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <select name="event" id="event" class="form-control" wire:model='eventType'>
                <option value="all">All Event</option>
                <option value="created">Created</option>
                <option value="updated">Updated</option>
                <option value="deleted">Deleted</option>
                <option value="restored">Restored</option>
            </select>
        </div>
        <div class="col-md-4">
            <select name="event" id="event" class="form-control" wire:model='auditType'>
                <option value="all">All Type</option>
                @foreach ($this->auditableType as $type)
                    <option value="{{ $type->auditable_type }}">{{ $type->auditable_type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            total: {{ $this->audits->total() }}
        </div>
    </div>

    <div class="card">
        <div class="card-table table-responsive">
            <table class="table table-sm table-hover">
                <tr>
                    <th>Event</th>
                    <th>Type</th>
                    <th>Old Values</th>
                    <th>New Values</th>
                </tr>
                @foreach ($this->audits as $audit)
                <div x-data="{
                    show: false
                }"  wire:key='{{ str()->random() }}'>
                    <tr>
                        <td>
                            <strong>{{ $audit->event }}</strong> <br>
                            {{ $audit->user?->name ?? 'unknown' }} <br>
                            @if (str($audit->event)->contains('deleted'))
                                <button class="btn btn-primary" wire:click="restoreFromAudit({{ $audit->id }})">restore</button>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $audit->auditable_type }}</strong> <br>
                            {{ $audit->updated_at->format('d F Y H:i') }}
                        </td>
                        <td width="30%">
                            @foreach ($audit->old_values as $key => $value)
                                @if ($value)
                                    @if ($key == 'note')
                                    <strong>{{ $key }} monster</strong> <br>
                                     {{ (json_decode($value)->monster) ?? '-' }} <br>
                                    <strong>{{ $key }} npc</strong> <br>
                                     {{ json_decode($value)->npc ?? '-' }}  <br>
                                    @else
                                    <strong>{{ $key }}</strong> : {{ $value }} <br>
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td width="30%">
                            @foreach ($audit->new_values as $key => $value)
                                @if ($value)
                                    @if ($key == 'note')
                                    <strong>{{ $key }} monster</strong> <br>
                                     {{ (json_decode($value)->monster) ?? '-' }} <br>
                                    <strong>{{ $key }} npc</strong> <br>
                                     {{ json_decode($value)->npc ?? '-' }}  <br>
                                    @else
                                    <strong>{{ $key }}</strong> : {{ $value }} <br>
                                    @endif
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    @if ($this->audits->hasPages())
    <div class="py-3 w-full">
        {{ $this->audits->links('vendor.livewire.simple-bootstrap') }}
    </div>
    @endif
</div>

@section('head')
@livewireStyles
<script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('footer')
    @livewireScripts
@endsection
