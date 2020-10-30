<div>
    <h4 class="text-muted text-center"> Results {{ $formulas->total() }}  formula(s) </h4>
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body p-3">

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
    @foreach($formulas as $formula)
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $formula->note }} </h3>
            </div>

            <div class="card-body p-2">
                <div class="d-block mb-2">

                    <table width="100%">
                        <tr>
                            <th width="35%"> Type</th>
                            <td class=""> {{ $formula->type }} </td>
                        </tr>
                        <tr>
                            <th width="35%"> Starting Pot </th>
                            <td> {{ $formula->starting_pot }} </td>
                        </tr>
                        <tr>
                            <th width="35%"> Highest Mats </th>
                            <td> {{ $formula->highest_mats }} </td>
                        </tr>
                        <tr class="{{ $formula->success_rate < 100 ? 'text-danger' : 'text-success'}}">
                            <th width="35%"> Success Rate </th>
                            <td> {{ $formula->success_rate }}%</td>
                        </tr>
                    </table>

                </div>

                <div class="bg-blue-lightest px-3 py-2">
            	{!! $formula->final_step !!}
                </div>

                <div class="mt-2">
                    <small class="text-muted float-left"><b>Created: </b> {{ $formula->created_at->format('d-M-Y H:i') }} </small>
                    <a href="/fill_stats/show/{{ $formula->id }}" class="float-right btn btn-sm btn-pill btn-outline-primary">Show</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-md-12">
    	{{ $formulas->onEachSide(1)->links() }}
    </div>
</div>
</div>