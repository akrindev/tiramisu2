<div class="row">
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
                        <tr class="{{ $formula->success_rate === 100 ? 'text-success' : 'text-danger'}}">
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
                    <button class="float-right btn btn-sm btn-pill btn-outline-primary" wire:click="show({{ $formula->id }})">Show</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-md-12">
    	{{ $formulas->links('vendor.pagination.livewire-pagination') }}
    </div>
</div>