@extends('layouts.tabler')

@section('content')
@php
  $ele = DB::table('elements')->get();
    @endphp
<div class="divider"></div>
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-md-8">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah drop</h3>
      </div>
      <div class="card-alert alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div>
      <div class="card-body" style="font-size:13px;font-weight:400">

        {!! form_open_multipart('/mons/drop/store',["id"=>"tambah-drop"]) !!}

        <div class="form-group">
          <label class="form-label">Nama</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
          <label class="form-label">Type</label>
          <select name="type" id="select-type" class="form-control custom-select" required>
          @foreach((new App\DropType)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}'>{{$type->name}}</option>
          @endforeach
          </select>
        </div>

          <div class="form-group">
            <label class="form-label">NPC Selling price</label>
            <input type="number" class="form-control" name="sell">
          </div>


          <div class="form-group">
            <label class="form-label">Proses pts</label>
            <input type="number" class="form-control" name="proses" >
          </div>

          <div class="form-group">
            <label class="form-label">Tambahan / Note / Status weapon / item <small class="text-muted">boleh kosong</small></label>
            <textarea name="note" rows="5" class="form-control"></textarea>
          </div>


          <div class="form-group">
            <label class="form-label">Screenshot</label>
            <div id="preview"></div>
            <input type="file" name="picture" class="form-control" accept="image/*">
          </div>

        <div class="form-group">
          <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
        </div>

        @csrf
        {!! form_close() !!}

      </div>
    </div>

  </div>

    </div>
  </div>
</div>

@endsection

@section('head')
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
(function(){
  let form = document.getElementById("tambah-drop");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post('/mons/drop/store', data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data drop telah di tambahkan", {
          	icon: 'success'
          }).then(() => {
          	form.reset();
 var control = $select[0].selectize;
 control.clear();
          });
        } else {
          swal("Data drop sudah ada",{
          	icon: 'error'
          });
        }

      simpan.innerHTML = 'Simpan';
    }).catch((err) => alert(err));
  });


})();
</script>
@endsection