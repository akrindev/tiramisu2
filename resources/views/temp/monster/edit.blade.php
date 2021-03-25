@extends('layouts.tabler')

@section('title', 'Edit Monster: ' . $monster->name)

@section('content')
<div class="my-5">
  <div class="container">
      <div class="page-header">
          <h3 class="page-title">Edit data monster</h3>
      </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body body-text p-3">
                    <h4 class="text-danger">Peraturan sebelum mengubah data monster</h4>
                    <hr class="my-1">
                    - Pastikan data monster yang ingin di ubah sesuai dengan data yang ada di dalam game. <br>
                    - Masukkan nama monster sesuai dengan nama yang ada di dalam game. <br>
                    - Nama dalam bahasa indonesia tidak boleh kosong. <br>
                    - Nama dalam bahasa inggris boleh di kosongkan jika tidak tahu bahasa inggrisnya. <br>
                    - Jika kamu tahu nama monster hanya dalam bahasa inggrisnya saja, maka masukkan nama dalam bahasa inggris ke dalam kolom bahasa indonesia. <br>
					- Jika terdapat difficulty monster, tulislah difficulty di dalam tanda kurung. <i class="text-muted">contoh: Guignol (Easy), Guignol (Normal), etc.</i> <br>
                    - Pilihlah type monster sesuai jenis monster yang ada di dalam game. <i class="text-muted">normal monster, boss, mini boss.</i> <br>
                    - Apakah bisa di jadikan pet? jika tidak tahu tidak perlu di centang. <br>
                    - Pilih map mana monster tersebut muncul. <br>
                    - Level monster wajib di isi. <br>
                    - HP monster tidak wajib untuk diisi kecuali kamu tahu HP monster tersebut. <br>
                    - EXP monster tidak wajib untuk diisi kecuali kamu tahu EXP monster tersebut. <br>
                    - Sebelum memasukkan drop items, pastikan item sudah tersedia terlebih dahulu. Jika tidak ada <a href="/temp/drop/create">tambahkan drop item terlebih dahulu</a>. <br>
                    - Tidak perlu memasukkan gambar monster jika kamu belum mengambil screenshot gambar monster. Namun lebih baik terdapat gambar monster. <br>
                    - Jika terdapat gambar monster, potonglah terlebih dahulu dengan rasio 1:1 (persegi) <br>
                    - Gambar maksimal berukuran <strong>500KB</strong> <br>
                    - Tim kami akan mereview ulang semua data yang telah di tambahkan maupun yang di ubah.
                    <br><br>

                    <strong>
                        Terima Kasih telah ikut berkontribusi di situs ini
                    </strong>

                </div>
            </div>
        </div>


      <div class="col-md-6">

        <div class="card">
            <div class="card-header p-3">
                <h3 class="card-title">Edit data monster</h3>
            </div>
            {{-- <div class="card-alert alert alert-info">Jika data drop tidak di temukan, tambah data dropnya <a href="/mons/drop/store">disini</a> --}}
            {{-- </div> --}}

            <div class="card-body p-3" style="font-size:13px;font-weight:400">

            {!! form_open_multipart('/monster/'.$monster->id.'/edit',["id"=>"mons-catcher"]) !!}
            @csrf

            <div class="form-group">
                <label class="form-label">Nama (indonesia) <i class="text-danger">*</i></label>
                <input type="text" class="form-control" name="name" value="{{ $monster->name }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Name (English) <i class="text-muted">(optional)</i></label>
                <input type="text" class="form-control" name="name_en" value="{{ $monster->name_en }}">
            </div>

            <div class="form-group">
                <label class="form-label">Type <i class="text-danger">*</i></label>
                <div class="selectgroup selectgroup-pills">

                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="1" {{ $monster->type == 1 ? 'checked':''}}>
                        <span class="selectgroup-button">Normal mons</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="2" {{ $monster->type == 2 ? 'checked':''}}>
                        <span class="selectgroup-button">Mini Boss</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="3" {{ $monster->type == 3 ? 'checked':''}}>
                        <span class="selectgroup-button">Boss</span>
                    </label>
                </div>

            </div>

            <div class="form-group">
                <label class="form-label">Map <i class="text-danger">*</i></label>
                <select name="map" id="map" class="form-control custom-select" required>
                    <option value="">~ select map ~</option>
                    @foreach ((new App\Map)->get() as $map)
                    <option value="{{$map->id}}" {{ $monster->map_id == $map->id ? 'selected':''}}>{{ $map->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Bisa dijadikan pet?</label>
                <label class="custom-switch">
                <input type="checkbox" name="pet" class="custom-switch-input"  {{ $monster->pet == 'y' ? 'checked':''}}>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description"></span>
                </label>
            </div>

            <div class="row">
                <div class="col-4">

                    <div class="form-group">
                        <label class="form-label">level <i class="text-danger">*</i></label>
                        <input type="number" class="form-control" name="level" value="{{ $monster->level }}" required>
                    </div>

                </div>

                <div class="col-4">

                    <div class="form-group">
                        <label class="form-label">HP <i class="text-muted">(optional)</i></label>
                        <input type="number" class="form-control" name="hp" value="{{ str_replace(',', '', $monster->hp) }}">
                    </div>
                </div>

                <div class="col-4">

                    <div class="form-group">
                        <label class="form-label">XP <i class="text-muted">(optional)</i></label>
                        <input type="number" class="form-control" name="xp" value="{{ $monster->xp }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Drop items <i class="text-danger">*</i></label>
                <select id="drop-item" class="form-control" multiple="multiple" name="drops[]" required>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Element</label>
                <div class="selectgroup selectgroup-pills">
                @foreach ((new App\Element)->get() as $el)
                <label class="selectgroup-item">
                    <input type="radio" name="element" class="selectgroup-input" value="{{$el->id}}" {{ $el->id == $monster->element_id ? 'checked':'' }}>
                    <span class="selectgroup-button">{{ $el->name }}</span>
                </label>
                @endforeach
                </div>
            </div>

          <div class="form-group">
            <label class="form-label">Screenshot <i class="text-muted">(optional)</i></label>
            <div id="preview" class="mb-5">
            <img src="/{{ $monster->picture }}"/>
            </div>
            <input type="file" name="picture" class="form-control" accept="image/*" id="picture">
            <small class="text-muted">max 500KB</small>
          </div>


          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
          </div>

          <input type="hidden" name="id" value="{{ $monster->id }}">
          {!! form_close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('head')
<meta name="robots" content="noindex">
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<script src="/assets/js/vendors/selectize.min.js"></script>
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
<script>
  $('#map').selectize({
    render: {
      option: function (data, escape) {
        return '<div>' +
          '<span class="title">' + escape(data.text) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          escape(data.text) +
          '</div>';
      }
    }
  });
</script>
  <script>
  $('#drop-item').selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    create: false,
    persist: false,
    options: [],
    delimiter:',',
    render: {
      option: function (item, escape) {
        return '<div>' +
          '<span class="image"><img src="' + item.drop_type.url + '" alt=""></span>' +
          '<span class="title">' + escape(item.name) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          '<span class="image"><img src="' + data.drop_type.url + '" alt=""></span>' +
          escape(data.name) +
          '</div>';
      }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '/temp/monster/dl',
          	data: {
              q: query
            },
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res.data);
            }
        });
    },
    onInitialize: function(){
        var selectize = this;
        $.get("/temp/monster/fetch/{{ $monster->id }}", function( data ) {
            selectize.addOption(data); // This is will add to option
            var selected_items = [];
            $.each(data, function( i, obj) {
                selected_items.push(obj.id);
            });
            selectize.setValue(selected_items); //this will set option values as default
        });
    }
});
</script>

<script>
(function(){
  let form = document.getElementById("mons-catcher");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target);

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    axios.post('/temp/monster/edit/update', data)
    .then((res) => {

    	if(res.data.success) {
          swal("Data monster di edit dan menunggu review", {
          	icon: 'success'
          }).then(() => {
          	window.close()
          });
        }
    }).catch((err) => swal(err.message, { icon: 'error' }))
    .finally(() => {
    		simpan.innerHTML = 'Simpan';
    });

  });
})();
</script>

<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid" id="prev"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#picture").change(function(){
   fileReader(this);
 })
</script>

@endsection