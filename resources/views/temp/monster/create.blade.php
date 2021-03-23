@extends('layouts.tabler')

@section('title', 'Tambah data monster')
@section('description', 'Tambah data monster yang belum ada di database')

@section('content')
<div class="my-5">
    <div class="container">
    <div class="page-header">
      <h3 class="page-title">Create new monster</h3>
    </div>

      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body body-text p-3">
                    <h4 class="text-danger">Peraturan sebelum menambahkan data monster</h4>
                    <hr class="my-1">
                    - Pastikan monster yang ingin di tambahkan belum ada dalam database di situs ini. <br>
                    - Masukkan nama monster sesuai dengan nama yang ada di dalam game. <br>
                    - Nama dalam bahasa indonesia tidak boleh kosong. <br>
                    - Nama dalam bahasa inggris boleh di kosongkan jika tidak tahu bahasa inggrisnya. <br>
                    - Jika kamu tahu nama monster hanya dalam bahasa inggrisnya saja, maka masukkan nama dalam bahasa inggris ke dalam kolom bahasa indonesia. <br>
                    - Pilih type monster sesuai jenis monster yang ada di dalam game. <i class="text-muted">normal monster, boss, mini boss.</i> <br>
                    - Apakah bisa di jadikan pet? jika tidak tahu tidak perlu di centang. <br>
                    - Pilih map mana monster tersebut muncul. <br>
                    - Level monster wajib di isi. <br>
                    - HP monster tidak wajib untuk diisi kecuali kamu tahu HP monster tersebut. <br>
                    - EXP monster tidak wajib untuk diisi kecuali kamu tahu EXP monster tersebut. <br>
                    - Sebelum memasukkan drop items, pastikan item sudah tersedia terlebih dahulu. Jika tidak ada <a href="/temp/drop/create">tambahkan drop item terlebih dahulu</a>. <br>
                    - Tidak perlu memasukkan gambar monster jika kamu belum mengambil screenshot gambar monster. Namun lebih baik terdapat gambar monster. <br>
                    - Jika terdapat gambar monster, potonglah terlebih dahulu dengan rasio 1:1 (persegi) <br>
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
          <h3 class="card-title">Create new monster</h3>
        </div>
        <div class="card-body p-3" style="font-size:13px;font-weight:400">

            {!! form_open_multipart('/temp/monster/store', [ "id" => "mons-catcher" ]) !!}

            @csrf

            <div class="form-group">
              <label class="form-label">Name (indo) <i class="text-danger">*</i></label>
              <input type="text" class="form-control" name="name" placeholder="Nama monster dalam bahasa indonesia" required>
            </div>

            <div class="form-group">
              <label class="form-label">Name (english) <i class="text-muted">(optional)</i></label>
              <input type="text" class="form-control" name="name_en" placeholder="Nama monster dalam bahasa inggris">
            </div>

            <div class="form-group">
                <label class="form-label">Type <i class="text-danger">*</i></label>
                <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="1" checked>
                        <span class="selectgroup-button">Normal monster</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="2">
                        <span class="selectgroup-button">Mini Boss</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="3">
                        <span class="selectgroup-button">Boss</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
              <label class="form-label">Map <i class="text-danger">*</i></label>
              <select name="map" id="map" class="form-control custom-select" required>
                <option value="">~ Select map ~</option>
              @foreach ((new App\Map)->get() as $map)
                <option value="{{ $map->id }}"> {{ $map->name }} </option>
              @endforeach
              </select>
            </div>


            <div class="form-group">
              <label class="form-label">Bisa dijadikan pet? <i class="text-muted">(optional)</i></label>
              <label class="custom-switch">
                 <input type="checkbox" name="pet" class="custom-switch-input">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description"></span>
               </label>
            </div>

            <div class="row">
              <div class="col-4">

                <div class="form-group">
                    <label class="form-label">level <i class="text-danger">*</i></label>
                    <input type="number" class="form-control" name="level" placeholder="level" required>
                </div>

              </div>

              <div class="col-4">

                <div class="form-group">
                    <label class="form-label">HP <i class="text-muted">(optional)</i></label>
                    <input type="number" class="form-control" name="hp" placeholder="hp">
                </div>

              </div>


              <div class="col-4">

                <div class="form-group">
                    <label class="form-label">XP <i class="text-muted">(optional)</i></label>
                    <input type="number" class="form-control" name="xp" placeholder="xp">
                </div>

              </div>

            </div>

            <div class="form-group">
              <label class="form-label">Drop items <i class="text-danger">*</i></label>
                <select id="drop-item" class="form-control" multiple="multiple" name="drops[]" required>
              </select>
              <small class="d-block text-muted">tambahkan beberapa drop</small>
            </div>

            <div class="form-group">
                <label class="form-label">Element <i class="text-danger">*</i></label>
                <div class="selectgroup selectgroup-pills">
                @foreach ((new App\Element)->get() as $el)
                    <label class="selectgroup-item">
                        <input type="radio" name="element" class="selectgroup-input" value="{{ $el->id }}" {{ $loop->first ? 'checked':'' }}>
                        <span class="selectgroup-button">{{ $el->name }}</span>
                    </label>
                @endforeach
                </div>

            </div>

            <div class="form-group">
              <label class="form-label">Screenshot <i class="text-muted">(optional)</i></label>
              <div id="preview"></div>
              <input type="file" name="picture" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
            </div>

            {!! form_close() !!}


          <hr class="my-2">
          <i class="text-danger">*</i> wajib di isi. <br>
          <i class="text-muted">(optional)</i> tidak wajib untuk di isi.

        </div>
      </div>
    </div>


      </div>
    </div>
  </div>
@endsection


@section('head')
<link href="/assets/css/read.css" rel="stylesheet"/>
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
    function fileReader(input, el) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {

                $(el).html('Preview: <img src="'+e.target.result+'" class="img-fluid mb-5"/>');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
     $("#picture").change(function(){
       fileReader(this, "#preview");
     })
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
      create: true,
      options: [],
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

      axios.post('/temp/monster/store', data)
      .then((res) => {

          if(res.data.success) {
            swal("Data monster ditambah", {
                icon: 'success'
            }).then((res) => {
                form.reset();
                form.clear();
            });
        }

    }).catch((err) => alert(err)).finally(() => {
        simpan.innerHTML = 'Simpan';
      });
    });
  })();
  </script>
@endsection
