<div>
    <div class="alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div>
    <div class="card">
        <div class="card-body" style="font-size:13px;font-weight:400">

        <form wire:submit.prevent="save" enctype="multipart/form-data" method="post" accept-charset="utf8" id="edit-drop">

          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" wire:model.defer='name' name="name" class="form-control" required>
          </div>

            <div class="form-group">
            <label class="form-label">Name English *optional</label>
            <input type="text" wire:model.defer='name_en' name="name_en" class="form-control">
          </div>

          <div class="form-group" wire:ignore>
            <label class="form-label">Type</label>
            <select name="type" wire:model.defer='tipe' id="select-type" class="form-control custom-select" required>
            @foreach((new App\DropType)->get() as $type)
              <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}'>{{$type->name}}</option>
            @endforeach
            </select>
          </div>

        <div class="form-group">
            <label class="form-label">Tambahan / Note (Monster) <small class="text-muted">boleh kosong</small></label>
            <textarea name="monster" wire:model.defer='monster' rows="5" class="form-control" placeholder="Status Monster . . ."></textarea>
        </div>


            <div class="form-group">
              <label class="form-label">Tambahan / Note (NPC) <small class="text-muted">boleh kosong</small></label>
              <textarea name="npc" wire:model.defer='npc' rows="5" class="form-control" placeholder="Status NPC . . ."></textarea>
            </div>


            <div class="form-group">
                <label class="form-label">Screenshot</label>

                @if (!$newPicture)
                <div id="oldpic">
                    @if ($picture)
                        <img src="/{{ $picture }}" style="max-width: 100%" class="d-block"/>

                        <button class="btn btn-danger btn-sm" wire:click.prevent='deletePicture'>hapus screenshot</button>
                    @endif
                </div>
                @endif

                <div id="preview" wire:ignore></div>

                <input type="file" wire:model='newPicture' name="picture" class="form-control" accept="image/*" id="picture">
            </div>


        <div class="form-group">
            <label class="form-label">Screenshot full image for armor</label>
            @if (!$newFullimage)
            <div id="oldpic">
                @if ($fullimage)
                  <img src="/{{ $fullimage }}" style="max-width: 100%" class="d-block"/>


                  <button class="btn btn-danger btn-sm" wire:click.prevent='deleteFullimage'>hapus screenshot</button>
                @endif
            </div>
            @endif

            <div id="preview2" wire:ignore></div>
                <input type="file" wire:model='newFullimage' name="fullimage" class="form-control" accept="image/*" id="fullimage"/>
        </div>

          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>

            <button class="btn btn-outline-primary" wire:click.prevent='cancel'>Cancel</button>
            <button class="btn btn-outline-danger float-right" id="hapus">hapus</button>
          </div>

          @csrf
        </form>

        </div>
      </div>

      {{-- js --}}
@verbatim

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function fileReader(input, el) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    $(el).html('Preview: <img src="'+e.target.result+'" class="img-fluid"/>');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#picture").change(function(){
            fileReader(this, "#preview");
        })

        $("#fullimage").change(function(){
          fileReader(this, '#preview2');
        })

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
            }
        });

        var s = $select[0].selectize;
        s.on('change', function (e) {
            Livewire.emit('changeTipe', e);
        })

        Livewire.on('saved', f => {
                $('#preview').html('');
                $('#preview2').html('');

                let form = document.getElementById("edit-drop");

                form.reset();
        });

        Livewire.on('getData', d => {
            s.setValue(d.drop_type_id);
        });

        var hapus = document.getElementById('hapus');
        hapus.innerHTML = "Hapus";

        hapus.addEventListener('click', (e) => {
        	e.preventDefault();

            swal({
                title:'Yakin mau hapus ini?',
                text:'data tidak bisa di kembaikan setelah di hapus',
                icon:'warning',
                buttons:true,
                dangerMode:true
            }).then((ya) => {
                if(ya) {
                    Livewire.emit('delete', 1);
                    hapus.innerHTML = 'deleting . . .'
                } else {
                    swal('aman gan');
                }
            });
  });


    });


    </script>

@endverbatim
  </div>
