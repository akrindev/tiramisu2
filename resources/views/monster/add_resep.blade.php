@extends('layouts.tabler')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Tambah resep</h1>
    </div>


    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-alert alert alert-info">
            tambah data monster <a href="/mons/store">disini</a>
          </div>
          <div class="card-body p-3">
            {!! form_open('/mons/store/resep',['id'=>'resep-catcher']) !!}
            @csrf
            <div class="form-group">
              <label class="form-label">Drop dari</label>
              <select name="drop" id="drop-item" class="form-control custom-select" required></select>
            </div>

            <div class="form-group">
              <div class="row gutters-xs">
                <div class="col-8"><label class="form-label">Bahan</label></div>
                <div class="col-4"><label class="form-label">Butuh</label></div>

                <div id="resep" class="resep">
               @for($i=1; $i < 7; $i++)
                  <select name="bahan[]" class="form-control custom-select bahan{{$i}} col-8 mr-4" style="display:inline-block"></select>
                  <input type="number" name="butuh[]" class="form-control col-3" style="display:inline-block">
               @endfor
                </div>

              </div>
            </div>

          <div class="form-group">
            <div class="row gutters-xs">
              <div class="col-6">
              <label class="form-label">NPC Fee</label>
                <input type="number" name="fee" class="form-control">
              </div>
              <div class="col-6">
              <label class="form-label">level</label>
                <input type="number" name="level" class="form-control">
              </div>
              <div class="col-6">
              <label class="form-label">Difficulty</label>
                <input type="number" name="diff" class="form-control">
              </div>

            <div class="col-6">

          <div class="form-group">
            <label class="form-label">Set</label>
            <input type="number" class="form-control" name="set">
          </div>

               <div class="col-6">
              <label class="form-label">Base pot</label>
                <input type="number" name="pot" class="form-control">
              </div>

            <div class="col-6">

          <div class="form-group">
            <label class="form-label">Base atk/def</label>
            <input type="number" class="form-control" name="base">
          </div>
            </div>
            </div>
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-outline-primary btn-sk btn-pill" id="simpan" type="submit">Simpan</button>
          </div>
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
   $('#drop-item').selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    create: false,
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
            url: '/mons/store',
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

    for(var i = 1; i < 7; i++) {

       $('.bahan'+i).selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    create: false,
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
            url: '/mons/store',
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
    }

    </script>
<script>
(function(){
  let form = document.getElementById("resep-catcher");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post('/mons/store/resep', data)
    .then((res) => {
    	simpan.innerHTML = 'Simpan';

    	if(res.data.success) {
          swal("Resep berhasil di buat", {
          	icon: 'success'
          }).then(() => {
            form.reset();
          });
        }
    }).catch((err) => alert(err));

  });
})();
</script>

@endsection