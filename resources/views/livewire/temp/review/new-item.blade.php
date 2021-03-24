<div>

    <h3>New items</h3>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session(('success')) }}</div>
    @endif

    @forelse ($items as $item)

        @livewire('temp.review.new-item-card', ['item' => $item], key($item->id))

    @empty
        <div class="card">
            <div class="card-body">
                empty
            </div>
        </div>
    @endforelse

    <div class="my-4">
        {{ $items->links() }}
    </div>
</div>
