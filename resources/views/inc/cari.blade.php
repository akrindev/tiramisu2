{!! form_open('/search',["method"=>"GET", "itemprop" => "potentialAction", "itemscope itemtype"=>"https://schema.org/SearchAction"]) !!}
<meta itemprop="target" content="{{ url('/search') }}?q={q}">
<div class="form-group">
  <div>
    <div class="input-icon">
      <span class="input-icon-addon"><i class="fe fe-search"></i></span>
      <input itemprop="query-input" type="search" name="q" class="form-control" placeholder="Nama item, weapon, armor, monster, forum dll . . ." value="{{ request()->q ?? '' }}" pattern=".{2,}" title="2 karakter atau lebih" required>
    </div>
    <small class="text-muted">cari dalam bahasa indonesia</small>
   </div>
  </div>
{!! form_close() !!}