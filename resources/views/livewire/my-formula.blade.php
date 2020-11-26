<div>
    <div>
        <h4 class="text-muted text-center"> Results {{ $formulas->total() }}  formula(s) </h4>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body p-3">

                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name='ctype' value='s' class="selectgroup-input" checked="" wire:click="changeType('s')">
                            <span class="selectgroup-button">Saved Formula</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name='ctype' value='l' class="selectgroup-input" wire:click="changeType('l')">
                            <span class="selectgroup-button">Loved Formula</span>
                        </label>
                    </div>
    
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="id" class="selectgroup-input" checked="" wire:click="formulaType('all')">
                        <span class="selectgroup-button">All</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="id" class="selectgroup-input" wire:click="formulaType('a')">
                        <span class="selectgroup-button">Armor</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="w" class="selectgroup-input" wire:click="formulaType('w')">
                        <span class="selectgroup-button">Weapon</span>
                    </label>
                </div>
    
                </div>
            </div>
        </div>
        @forelse($formulas as $formula)
            @livewire('card-formula', ['formula' => $formula], key($formula->id))
        @empty

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <strong>You dont have any saved formula!!!</strong>

                </div>
            </div>
        </div>
        @endforelse

        <div class="col-md-12">
            {{ $formulas->onEachSide(1)->links() }}
        </div>
    </div>
    </div>
</div>
