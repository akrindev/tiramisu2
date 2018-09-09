{!! form_open('/search',["method"=>"GET"]) !!}
<div class="form-group">
  <div>
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </span>
                  <input type="search" name="q" class="form-control" placeholder="Nama item, weapon, armor, monster dll . . ." value="{{ request()->q ?? '' }}" pattern=".{2,}" title="2 karakter atau lebih" required>
                </div>
    <small class="text-muted">cari dalam bahasa indonesia</small>
   </div>
  </div>
{!! form_close() !!}