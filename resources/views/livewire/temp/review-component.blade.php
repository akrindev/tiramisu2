<div>
    <div wire:loading class="alert alert-success">
    Loading . . .
    </div>

    @switch($component)
        @case('updated_item')
            @livewire('temp.review.updated-item')
            @break
        @case('new_monster')
            @livewire('temp.review.new-monster')
            @break
        @case('updated_monster')
            @livewire('temp.review.updated-monster')
            @break
        @default
            @livewire('temp.review.new-item')

    @endswitch
</div>
