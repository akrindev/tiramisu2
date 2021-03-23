<div class="card">
    <div class="card-body">
        - <a href="#" wire:click.prevent="$emitTo('temp.review-component', 'component', 'new_item')">New items drop</a> <br>
        - <a href="#" wire:click.prevent="$emitTo('temp.review-component', 'component', 'updated_item')">Updated items</a> <br>
        <hr class="my-2">

        - <a href="#" wire:click.prevent="$emitTo('temp.review-component', 'component', 'new_monster')">New Monster</a> <br>
        - <a href="#" wire:click.prevent="$emitTo('temp.review-component', 'component', 'updated_monster')">Updated Monster</a> <br>

        <hr class="my-2">
        <strong>Reviewed</strong> <br>
    </div>
</div>
