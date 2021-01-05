<div>
    <h4 class="text-center text-muted"> Results {{ $formulas->total() }}  formula(s) </h4>
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="p-3 card-body">

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

    <div wire:loading class="col-md-3">
        <div>
            <div class="alert alert-success">Loading . . .</div>
        </div>
    </div>

    @foreach ($formulas as $formula)
        @livewire('card-formula', ['formula' => $formula], key($formula->id))
    @endforeach

    <div wire:loading class="col-md-3">
        <div>
            <div class="alert alert-success">Loading . . .</div>
        </div>
    </div>

    <div class="col-md-12">
    	{{ $formulas->onEachSide(1)->links() }}
    </div>
</div>
</div>
