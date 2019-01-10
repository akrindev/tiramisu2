@extends('layouts.tabler')

@section('title', 'Store Npc Quest')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Store Npc Quest</h3>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah data Npc Quest</h3>
          </div>
          <div class="card-body p-3" style="font-size:13px">

            {!! form_open('/npc/store/quest',["id" => "store-npc"]) !!}
            @csrf

          <div class="form-group">
            <label class="form-label">Nama Npc</label>
            <select name="npc" id="npc" class="form-control custom-select" required>
              <option value=""></option>
            @foreach ((new App\Npc)->get() as $npc)
              <option value="{{ $npc->id }}">{{ $npc->name }}</option>
            @endforeach
            </select>
          </div>


         <div class="form-group">
           <label class="form-label">Nama Quest</label>
           <input type="text" class="form-control" name="name" required>
         </div>

         <div class="form-group">
           <div class="row">
             <div class="col-6">
               <label class="form-label">Min. level</label>
               <input type="number" class="form-control" name="level" required>
             </div>
             <div class="col-6">
             <label class="form-label">Hadiah Xp</label>
               <input type="number" class="form-control" name="exp" required>
             </div>
           </div>
         </div>

          <div class="form-group">
            <label class="form-label">detail</label>
            <textarea name="detail" class="form-control"></textarea>
            <small class="text-muted">boleh kosong</small>
          </div>

            <hr class="my-1">

          <div class="form-group">
            <label class="form-label">Tujuan</label>

            <div class="row">
              <div class="col-12">
                  <b>Defeat</b>
              </div>
            <div class="col-8">Nama monster</div>
            <div class="col-4">Banyaknya</div>

                <div id="defeat" class="defeat p-1">
               @for($i=1; 7 > $i; $i++)
                  <select name="defeat[]" class="form-control custom-select defeat{{$i}} col-8 mr-4" style="display:inline-block"></select>
                  <input type="number" name="dmany[]" class="form-control col-3" style="display:inline-block">
               @endfor
                </div>

            <div class="col-12 mt-5">

            <b>Kumpulkan / Cari item</b>
            </div>
            <div class="col-8">Nama item</div>
            <div class="col-4">Banyaknya</div>

                <div id="drop" class="drop p-1">
               @for($i=1; 7 > $i; $i++)
                  <select name="drop[]" class="form-control custom-select drop{{$i}} col-8 mr-4" style="display:inline-block"></select>
                  <input type="number" name="ddmany[]" class="form-control col-3" style="display:inline-block">
               @endfor
                </div>

          </div>
         </div>

         <div class="form-group">
           <hr class="my-1">
            <b>Reward / Hadiah</b> <br>
           <div class="row">
            <div class="col-12 mt-5">

            <b>hadiah item</b>
            </div>
            <div class="col-8">Nama reward item</div>
            <div class="col-4">Banyaknya</div>

                <div id="reward" class="reward p-1">
               @for($i=1; 7 > $i; $i++)
                  <select name="reward[]" class="form-control custom-select reward{{$i}} col-8 mr-4" style="display:inline-block"></select>
                  <input type="number" name="rmany[]" class="form-control col-3" style="display:inline-block">
               @endfor
                </div>
           </div>
            </div>


          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="btn-tambah">Simpan</button>
          </div>


            {!! form_close() !!}

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px">
            <i class="fe fe-plus"></i> <a href="/npc/store">store npc</a> <br>
            <i class="fe fe-plus"></i> <a href="/npc/store/quest">store quest</a> <br>

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
  $('#npc').selectize({
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
let submit = document.getElementById('store-npdc'),
    btnSubmit = document.getElementById("btn-tambah");

  submit.addEventListener('submit', (e) => {
  	e.preventDefault();

    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan . . .';

    let data = new FormData(e.target);

    axios.post('/npc/store/quest', data)
    .then(res => {

    	btnSubmit.innerHTML = 'Simpan';
      	if(res.data.success) {
          swal("data disimpan", {
          	icon: 'success'
          });
        }

      submit.reset();
      $("#npc")[0].selectize.clear();

    for(var i = 1; i < 7; i++) {
      $(".defeat"+i)[0].selectize.clear();
      $(".drop"+i)[0].selectize.clear();
      $(".reward"+i)[0].selectize.clear();
    }


    })
    .catch(err => alert(err));
  });
</script>
<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid mb-3"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#gambar").change(function(){
   fileReader(this);
 })
</script>
<script>
// how many defeat monster
    for(var i = 1; i < 7; i++) {

       $('.defeat'+i).selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    create: false,
    options: [],
    render: {
      option: function (item, escape) {
        return '<div>' +
          '<span class="title">' + escape(item.name) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          escape(data.name) +
          '</div>';
      }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '/npc/store/quest',
          	data: {
              q: query
            },
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }
});
    }


    for(var i = 1; i < 7; i++) {

       $('.drop'+i).selectize({
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
            url: '/npc/store/quest',
          	data: {
              d: query
            },
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }
});
    }


    for(var i = 1; i < 7; i++) {

       $('.reward'+i).selectize({
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
            url: '/npc/store/quest',
          	data: {
              d: query
            },
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }
});
    }
</script>
@endsection