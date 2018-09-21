@extends('layouts.tabler')

@section('title', 'Edit Npc')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Edit Npc</h3>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit data Npc</h3>
          </div>
          <div class="card-body p-3" style="font-size:13px">

            {!! form_open('/',["id" => "store-npc"]) !!}
            @csrf

            <div class="form-group">
              <label class="form-label">Nama Npc</label>
              <input type="text" class="form-control" name="name" value="{{ $npc->name }}" required>
            </div>


          <div class="form-group">
            <label class="form-label">Map</label>
            <select name="map" id="map" class="form-control custom-select" required>
              <option value=""></option>
            @foreach ((new App\Map)->get() as $map)
              <option value="{{$map->id}}" {{ $map->id == $npc->map_id ? 'selected':'' }}>{{ $map->name }}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
             <div class="form-label">Screenshot NPC</div>
               <div id="preview">
                 @if ($npc->picture)
                 <img src="{{ $npc->picture }}" class="mb-3">
                 @endif
               </div>
                 <div class="custom-file">
                    <input type="file" class="custom-file-input mr-5" name="picture" id="gambar" accept="image/*">
                    <label class="custom-file-label"></label>
                  </div>
           </div>

            <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="btn-tambah">Simpan</button>
            </div>

            <input type="hidden" name="id" value="{{ $npc->id }}">
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
let submit = document.getElementById('store-npc'),
    btnSubmit = document.getElementById("btn-tambah");

  submit.addEventListener('submit', (e) => {
  	e.preventDefault();

    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan . . .';

    let data = new FormData(e.target);
    data.append('_method', 'put');

    axios.post('/npc/edit', data)
    .then(res => {

    	btnSubmit.innerHTML = 'Simpan';
      	if(res.data.success) {
          swal("data disimpan", {
          	icon: 'success'
          }).then(() => window.location.href = '/npc/npc-'+res.data.id);
        }
      submit.reset();

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

@endsection