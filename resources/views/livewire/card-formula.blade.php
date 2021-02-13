
    <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $formula->note }} </h3>
                </div>

                <div class="p-2 card-body">
                    <div class="mb-2 d-block">

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

                    <div class="px-3 py-2 bg-blue-lightest">
                    {!! $formula->final_step !!}
                    </div>

                    <div class="mt-2">
                        <small class="float-left text-muted"><b>Created: </b> {{ $formula->created_at->format('d-M-Y H:i') }} </small>

                        <button
                            @if (auth()->check() && in_array(auth()->id(), $formula->users->pluck('id')->toArray()))
                                class="float-right btn btn-sm btn-pill btn-danger disabled" disabled
                            @else
                                wire:click="save({{ $formula->id }})"
                                wire:loading.class="btn-loading"
                                class="float-right btn btn-sm btn-pill btn-danger"
                            @endif >
                            {{ $formula->users->count() > 0 ? $formula->users->count() : '' }}
                            {{ Illuminate\Support\Str::plural('love', $formula->users->count()) }}
                        </button>

                        <a wire:click.prevent="show({{ $formula->id }})" wire:loading.class="btn-loading" href="#" class="float-right mx-1 btn btn-sm btn-pill btn-outline-primary">Show</a>
                    </div>
                </div>
            </div>
        </div>