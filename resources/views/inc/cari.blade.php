<div class="page-header">
{!! form_open('/search',["method"=>"GET", "itemprop" => "potentialAction", "itemscope itemtype"=>"https://schema.org/SearchAction"]) !!}
<meta itemprop="target" content="{{ url('/search') }}?q={q}">
<div class="page-options d-flex">
    <div class="input-icon mr-1">
      <span class="input-icon-addon">
        <i class="fe fe-search"></i>
      </span>
      <input itemprop="query-input" type="search" name="q" class="form-control w-10" placeholder="Nama item, perlengkapan, monster, forum dll . . ." value="{{ request()->q ?? '' }}" pattern=".{2,}" title="2 karakter atau lebih" required>
    </div>

      <select class="form-control custom-select w-auto" name="type">
        <option value="name_only" {{ request()->type == 'name_only' ? 'selected' : '' }}>Nama</option>
        <option value="status_only" {{ request()->type == 'status_only' ? 'selected' : '' }}>Status</option>
    </select>
   </div>
{!! form_close() !!}

    <small class="text-muted">cari dalam bahasa indonesia</small>
</div>