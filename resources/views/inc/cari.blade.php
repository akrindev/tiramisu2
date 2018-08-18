{!! form_open('/search',["method"=>"GET"]) !!}
<div class="form-group">
  <div class="input-group">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </span>
                  <input type="search" name="q" class="form-control" placeholder="Search here . . ." value="{{ request()->q ?? '' }}" pattern=".{2,}" title="2 karakter atau lebih" required>
                </div>
    <span class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Search! </button>
                   </span>
   </div>
  </div>
{!! form_close() !!}