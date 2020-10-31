@extends('layouts.sb-admin')

@section('title','Edit map')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <button class="btn btn-primary btn-pill mb-3" id="addMap">Tambah Map</button>
        <div class="card shadow">
          <div class="card-body p-3" style="font-size:14px;font-weight:350">

            @foreach($peta as $p)
            <i class="fas fa-map mr-1"></i> <a href="/peta/{{$p->id}}" id="map{{$p->id}}">{{ $p->name }}</a> [<a href="#" class="text-muted editMap" data="{{$p->id}}">edit</a>] @if($loop->first) <span class="text-danger">New!!!</span> @endif <br>
              <small class="text-muted" id="mapu{{$p->id}}"> {{ $p->name_en }} </small> <br/>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      {!! form_open('/store-peta',['id'=>'catch-peta']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit data peta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        @csrf
        <input type="hidden" name="id" id="mape">
        <div class="form-group">
          <label class="form-label">Name</label>
          <input type="text" id="input-map" class="form-control" name="nama" required>
        </div><div class="form-group">
          <label class="form-label">Name en *optional</label>
          <input type="text" id="input-map-en" class="form-control" name="name_en">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="simpan">Save</button>
      </div>

        {!! form_close() !!}
    </div>
  </div>
</div>




<div class="modal fade" id="addMapModal" tabindex="-1" role="dialog" aria-labelledby="addMapModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      {!! form_open('/',['id' => 'add-peta']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="addMapModalLabel">Tambah data map</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        @csrf
        <div class="form-group">
          <label class="form-label">Name</label>
          <input type="text" id="input-map" class="form-control" name="name" required>
        </div>
          <div class="form-group">
          <label class="form-label">Name en *optional</label>
          <input type="text" id="input-map-en" class="form-control" name="name_en" >
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="simpanMap">Save</button>
      </div>

        {!! form_close() !!}
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
$('.editMap').click(function(e) {
  e.preventDefault();

  var u = $(this).attr('data');
  var name = $("#map"+u).text();
  var nameEn = $("#mapu"+u).text();

  $('#input-map').val(name);
  $('#input-map-en').val(nameEn);
  $("#mape").val(u);
  $("#exampleModal").modal('show');

});

$('#addMap').click(function(e) {
	$("#addMapModal").modal('show');
});
</script>

<script>
(function(){
  let form = document.getElementById("catch-peta"),
      addMap = document.getElementById("add-peta");
  let sendTo = '/store/peta';

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target);

    document.getElementById('simpan')
    .innerHTML = '<i class="fa fa-spinner fa-spin"></i> menyimpan';

    axios.post(sendTo, data)
    .then((res) => {
    	if(res.data.success) {
          swal('berhasil di ubah', {
          	icon: 'success'
          }).then(() => {
            const theID = jQuery("#mape").val();
            const theNama = jQuery("#input-map").val();
            const theNameEn = jQuery("#input-map-en").val();

            jQuery("#exampleModal").modal('hide');
            form.reset();
            jQuery("#map"+theID)
              .text(theNama);

            jQuery("#mapu"+theID)
              .text(theNameEn);
          });
        }

    document.getElementById('simpan')
    .innerHTML = 'Simpan';

    }).catch((err) => alert(err));
  });


  addMap.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target);

    document.getElementById('simpanMap')
    .innerHTML = '<i class="fa fa-spinner fa-spin"></i> menyimpan';

    axios.post('/save/new-map', data)
    .then((res) => {
    	if(res.data.success) {
          swal('Data map telah di tambahkan', {
          	icon: 'success'
          }).then(() => {
            jQuery("#addMapModal").modal('hide');
            window.location.reload();
          });
        }

    document.getElementById('simpanMap')
    .innerHTML = 'Simpan';

    }).catch((err) => alert(err));
  });
})();
</script>
@endsection