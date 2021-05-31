<div class="container-fluid">
    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
      <h1 class="mb-0 text-gray-800 h3">Tambah Drop</h1>
      <!--<a href="#" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <div class="row">
      <div class="col-md-8">
       <div class="shadow card">
        <div class="card-alert alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div>
        <div class="card-body" style="font-size:13px;font-weight:400">

          <form wire:submit.prevent="save" enctype="multipart/form-data" method="post" accept-charset="utf8" id="tambah-drop">

          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" wire:model.defer="name" name="name" class="form-control" required>
          </div>


          <div class="form-group">
            <label class="form-label">Name English *optional</label>
            <input type="text" wire:model.defer="name_en" name="name_en" class="form-control">
          </div>


          <div class="form-group" wire:ignore>
            <label class="form-label">Type</label>
            <select name="type" id="select-type" class="form-control custom-select" required>
            @foreach((new App\DropType)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}'>{{ $type->name }}</option>
            @endforeach
            </select>
          </div>
{{--
            <div class="form-group">
              <label class="form-label">NPC Selling price</label>
              <input type="number" class="form-control" name="sell" placeholder="Boleh kosong">
            </div>


            <div class="form-group">
              <label class="form-label">Proses pts</label>
              <input type="number" class="form-control" name="proses" placeholder="Boleh kosong">
            </div>
   --}}
            <div class="form-group">
              <label class="form-label">Deskripsi item (MONSTER) <small class="text-muted">boleh kosong</small></label>
              <textarea wire:model.defer="monster" name="noteMonster" rows="5" class="form-control" placeholder="Status Monster . . ."></textarea>
            </div>

            <div class="form-group">
              <label class="form-label">Deskripsi Status item (NPC) <small class="text-muted">boleh kosong</small></label>
              <textarea wire:model.defer="npc" name="noteNpc" rows="5" class="form-control" placeholder="Status Npc . . ."></textarea>
            </div>


            <div class="form-group">
              <label class="form-label">Screenshot</label>
              <div id="preview" wire:ignore></div>
              <input type="file" wire:model="picture" name="picture" class="form-control" accept="image/*" id="picture">
            </div>

            <div class="form-group">
              <label class="form-label">Screenshot full image for armor</label>
              <div id="preview2" wire:ignore></div>
              <input type="file" wire:model="fullimage" name="fullimage" class="form-control" accept="image/*" id="fullimage">
            </div>


          <div class="form-group">
              <label class="form-label">Released Date</label>
              <input type="date" wire:model.defer="released" class="form-control" id="">
          </div>


          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
          </div>

          @csrf
          </form>
        </div>
      </div>

      </div>
    </div>
    @verbatim
    <script>
      document.addEventListener("DOMContentLoaded", function () {

      var $select = $('#select-type').selectize({
        render: {
          option: function (data, escape) {
            return '<div>' +
              '<span class="image"><img src="' + data.image + '" alt=""></span>' +
              '<span class="title">' + escape(data.text) + '</span>' +
              '</div>';
            },
            item: function (data, escape) {
              return '<div>' +
                '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                escape(data.text) +
                '</div>';
              }
            },
            onChange: function (value) {
              Livewire.emit('changeTipe', value);

              console.log(value)
            }
          });

          Livewire.on('success', res => {

            if(res == 0) {
              swal("Data drop sudah ada",{
          	  icon: 'error'
               });
            } else {

            swal("Data drop telah di tambahkan", {
          	  icon: 'success'
            }).then(r => {

              let form = document.getElementById("tambah-drop");
              var control = $select[0].selectize;
              $("#preview").html('');
              $("#preview2").html('');
              control.clear();
              form.reset();
            });
            }
          });

    });
          </script>
          @endverbatim
  </div>
