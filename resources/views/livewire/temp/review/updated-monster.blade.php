<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3>Updated Monster</h3>

    @forelse ($monsters as $monster)
        @livewire('temp.review.updated-monster-card', ['monster' => $monster, 'maps' => $maps, 'elements' => $elements], key($monster->id))
    @empty
        <div class="card">
            <div class="card-body">
                empty
            </div>
        </div>
    @endforelse

    <div class="my-4">
        {{ $monsters->links() }}
    </div>
</div>
