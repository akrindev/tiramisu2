<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Edit Drop</h1>
        {{-- <a href="#" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
      </div>

      <div class="row">
        {{-- edit form   --}}
        <div class="col-12"></div>

        {{-- showing item --}}
        <div class="col-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <select name="type" wire:model="type" id="" class="form-control form-select">
                            <option value=0>All</option>
                            @foreach (App\DropType::get() as $d)
                                <option value={{ $d->id }}> {{ $d->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

               <div class="col-md-7">
                   <div class="form-group">
                       <input type="search" wire:model="search" min=3 class="form-control" placeholder="search here . . ."/>
                   </div>
               </div>

               <div wire:loading>
                   <div class="col-12">
                       <div class="alert alert-success"> Loading . . .</div>
                   </div>
               </div>

               @foreach ($items as $item)
                   @livewire('admin.drop-show', ['item' => $item], key($item->id))
               @endforeach

               <div wire:loading>
                   <div class="col-12">
                       <div class="alert alert-success"> Loading . . .</div>
                   </div>
               </div>

            {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
