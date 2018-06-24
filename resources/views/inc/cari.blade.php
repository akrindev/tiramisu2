{!! form_open('/cari') !!}
@csrf

            <div class="page-header">
              <h1 class="page-title">
                Cari
              </h1>
              <div class="page-subtitle">enter untuk mencari</div>
              <div class="page-options d-flex">

                <select name="type" class="form-control custom-select w-auto">
                  <option value="perlengkapan" >Perlengkapan</option>
                  <option value="crysta">Crysta</option>
                </select>
                <div class="input-icon ml-2">
                  <span class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </span>
                  <input type="search" name="key" class="form-control w-10" placeholder="Cari disini">
                </div>
</div>
            </div>

              {!! form_close() !!}