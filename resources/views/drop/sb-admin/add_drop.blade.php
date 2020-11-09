@extends('layouts.sb-admin')

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Drop</h1>
    <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
  </div>

  <div class="row">
    <div class="col-md-8">
     <div class="card shadow">
      <div class="card-alert alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div>
      <div class="card-body" style="font-size:13px;font-weight:400">

        {!! form_open_multipart('/mons/drop/store',["id"=>"tambah-drop"]) !!}

        <div class="form-group">
          <label class="form-label">Nama</label>
          <input type="text" name="name" class="form-control" required>
        </div>


        <div class="form-group">
          <label class="form-label">Name English *optional</label>
          <input type="text" name="name_en" class="form-control">
        </div>


        <div class="form-group">
          <label class="form-label">Type</label>
          <select name="type" id="select-type" class="form-control custom-select" required>
          @foreach((new App\DropType)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}'>{{ $type->name }}</option>
          @endforeach
          </select>
        </div>

          <div class="form-group">
            <label class="form-label">NPC Selling price</label>
            <input type="number" class="form-control" name="sell" placeholder="Boleh kosong">
          </div>


          <div class="form-group">
            <label class="form-label">Proses pts</label>
            <input type="number" class="form-control" name="proses" placeholder="Boleh kosong">
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi item (MONSTER) <small class="text-muted">boleh kosong</small></label>
            <textarea name="noteMonster" rows="5" class="form-control" placeholder="Status Monster . . ."></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi Status item (NPC) <small class="text-muted">boleh kosong</small></label>
            <textarea name="noteNpc" rows="5" class="form-control" placeholder="Status Npc . . ."></textarea>
          </div>


          <div class="form-group">
            <label class="form-label">Screenshot</label>
            <div id="preview"></div>
            <input type="file" name="picture" class="form-control" accept="image/*" id="picture">
          </div>

          <div class="form-group">
            <label class="form-label">Screenshot full image for armor</label>
            <div id="preview2"></div>
            <input type="file" name="fullimage" class="form-control" accept="image/*" id="fullimage">
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
@endsection


@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/selectize.css">
@endsection

@section('footer')
<script src="/assets/js/vendors/selectize.min.js"></script>
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
  let form = document.getElementById("tambah-drop");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post('/item/drop/store', data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data drop telah di tambahkan", {
          	icon: 'success'
          }).then(() => {
          	form.reset();
 var control = $select[0].selectize;
 control.clear();
            $("#preview").html('');
          });
        } else {
          swal("Data drop sudah ada",{
          	icon: 'error'
          });
        }

      simpan.innerHTML = 'Simpan';
    }).catch((err) => alert(err));
  });

</script>

<script>
function fileReader(input, el) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $(el).html('Preview: <img src="'+e.target.result+'" class="img-fluid"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#picture").change(function(){
   fileReader(this, '#preview');
 })
 $("#fullimage").change(function(){
   fileReader(this, '#preview2');
 })
</script>

@endsection