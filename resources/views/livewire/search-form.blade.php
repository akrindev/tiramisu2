
    <div class="col-md-8">
        <div class="page-header">
  <form wire:submit.prevent="submit()" method="GET" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction" accept-charset="utf8">
<meta itemprop="target" content="{{ url('/search') }}?q={q}">
<div class="page-options d-flex">
    <div class="input-icon mr-1">
      <span class="input-icon-addon">
        <i class="fe fe-search"></i>
      </span>
      <input wire:model="q" itemprop="query-input" type="search" name="q" class="form-control w-10 @error('q') is-invalid @enderror"placeholder="Search here . . ." value="{{ request()->q ?? '' }}" pattern=".{2,}" title="3 karakter atau lebih" required>
    </div>

      <select class="form-control custom-select w-auto" name="type" wire:model="type">
        <option value="name_only">Nama</option>
        <option value="status_only">Status</option>
    </select>
   </div>
  </form>
            @error('q')
    <small class="text-danger" id="q-error"> {{ $message }} </small>
            @enderror
</div>
	</div>