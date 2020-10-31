<div>
          <table class="card-table table table-striped table-hover" style="font-size:15px">
            <tr>
              <td><div><b>Note!</b>  <br> <span class="text-danger">Boss</span>  <span class="text-success ml-5">Mini Boss</span> </div></td>
            </tr>
              <tr>
                  <td>
                  <div class="form-group mb-2">
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="id" class="selectgroup-input" checked="" wire:click="switchLocalization('id')">
                    <span class="selectgroup-button">Indonesia</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="en" class="selectgroup-input" wire:click="switchLocalization('en')">
                    <span class="selectgroup-button">English</span>
                </label>
            </div>
              </div>
                  </td>
              </tr>

         @foreach ($mobs as $mob)
          <tr class="{{ $mob->type == 2 ? 'text-success':'text-danger' }}">
            <td class="px-2 py-2"><div> <a class="{{ $mob->type == 2 ? 'text-success':'text-danger' }}" href="/monster/{{ $mob->id }}"> {{ $mob->name }} (Lv {{ $mob->level }}) </a></div>
             <small class="text-muted">
               <a href="/peta/{{ $mob->map_id }}" class="text-muted">
               {{ $mob->map->name }}
               </a>
              </small>
            @if($mob->xp && $mob->persen)
              <br>
              <small class="text-primary"><i class="fe fe-arrow-up-circle mr-1"></i> {{ number_format($mob->xp) }} exp ({{ $mob->persen }}) <i class="fe fe-refresh-cw mx-1"></i> {{ $mob->defeat }}x run</small>
           @else
              <br>
              <small class="text-primary"><i class="fe fe-arrow-up-circle mr-1"></i> --unknown--</small>
           @endif
            </td>
          </tr>
         @endforeach
          </table>
</div>