@extends('layouts.tabler')

@section('title', 'Tambah data drop (item)')
@section('description', 'Tambah data drop (item) yang belum ada di database')

@section('content')
<div class="my-5">
    <div class="container">
    <div class="page-header">
      <h3 class="page-title">Create new drop (item)</h3>
    </div>

      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body body-text p-3">
                    <h4 class="text-danger">Peraturan sebelum menambahkan item</h4>
                    <hr class="my-1">
                    - Pastikan item yang ingin di tambahkan belum ada dalam database di situs ini. <br>
                    - Masukkan nama item sesuai nama yang ada di dalam game. <br>
                    - Nama dalam bahasa indonesia tidak boleh kosong. <br>
                    - Nama dalam bahasa inggris boleh di kosongkan jika tidak tahu bahasa inggrisnya. <br>
                    - Pilih tipe item sesuai jenis item yang ada di dalam game. <br>
                    - Terdapat 2 Deskripsi item yaitu deskripsi item dari drop dan deskripsi item dari npc. <br>
                    - Jika item berasal dari drop monster, masukkan dalam deskripsi status monster. <br>
                    - Jika item berasal dari npc, masukkan dalam deskripsi status NPC. <br>
                    - Jika kamu tahu kedua status deskripsi, masukkan semua deskripsi status. <br>
                    - Jika item tidak memiliki deskripsi, kosongkan semua deskripsi status dan hanya mengisi nama dan tipe saja. <i class="text-muted">contoh: jenis item logam, kain, fauna, etc.</i> <br>
                    - Jika terdapat gambar, potonglah gambar terlebih dahulu dengan ratio 1:1 (persegi). item yang di pakai dalam gambar harus hanya 1 item yang sesuai dan tidak mengenakan perlengkapan lain. background gambar lebih baik berwarna hitam. <br>
                    - Tidak perlu memasukkan gambar jika item tidak memiliki gambar atau jika kamu belum mengambil screenshot gambar. <br>
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
          <h3 class="card-title">Create new drop</h3>
        </div>
        {{-- <div class="card-alert alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div> --}}
        <div class="card-body p-3" style="font-size:13px;font-weight:400">

          {!! form_open_multipart('/temp/drop/store', [ "id" => "tambah-drop" ]) !!}

          <div class="form-group">
            <label class="form-label">Name (indo) <i class="text-danger">*</i> </label>
            <input type="text" name="name" class="form-control" placeholder="Nama dalam bahasa indonesia" required>
          </div>

          <div class="form-group">
            <label class="form-label">Name (english) <i class="text-muted">(optional)</i> </label>
            <input type="text" name="name_en" placeholder="Nama dalam bahasa inggris" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Type <i class="text-danger">*</i></label>
            <select name="type" id="select-type" class="form-control custom-select" required>
            @foreach((new App\DropType)->get() as $type)
              <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}'>{{$type->name}}</option>
            @endforeach
            </select>
          </div>


            <div class="form-group">
              <label class="form-label">Deskripsi item (MONSTER) <small class="text-muted">(optional)</small></label>
              <textarea name="noteMonster" rows="5" class="form-control" placeholder="Deskipsi status dari monster"></textarea>
            </div>

            <div class="form-group">
              <label class="form-label">Deskripsi Status item (NPC) <small class="text-muted">(optional)</small></label>
              <textarea name="noteNpc" rows="5" class="form-control" placeholder="Deskripsi status dari npc"></textarea>
            </div>


            <div class="form-group">
              <label class="form-label">Screenshot  <i class="text-muted">(optional)</i></label>
              <div id="preview"></div>
              <input type="file" id="picture" name="picture" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
              <label class="form-label">Screenshot (full armor light, normal, heavy)  <i class="text-muted">(optional)</i></label>
              <div id="preview2"></div>
              <input type="file" id="fullimage" name="fullimage" class="form-control" accept="image/*">
            </div>

          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
          </div>

          @csrf
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
     $("#fullimage").change(function(){
       fileReader(this, "#preview2");
     })
</script>


<script>
(function(){
  let form = document.getElementById("tambah-drop");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post('/temp/drop/store', data)
    .then((res) => {

    	if(res.data.success) {
          swal("Data drop telah di tambahkan", {
          	icon: 'success'
          }).then(() => {
          	form.reset();
            var control = $select[0].selectize;
            control.clear();
          });
        }

    }).catch((err) => {
        swal(err.message, {
            icon: 'error'
        });
    })
    .finally(() => {
        simpan.innerHTML = 'Simpan';
        document.getElementById('preview').innerHTML = ''
        document.getElementById('preview2').innerHTML = ''
    })
    ;
  });


})();
</script>
@endsection
