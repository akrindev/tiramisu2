@extends('layouts.tabler')

@section('title', 'Need Contribution')


@section('content')
<div class="my-5">
  <div class="container">

    <div class="page-header">
      <h3 class="page-title">Need Contribution</h3>
    </div>

    <div class="row">
      <div class="col-md-4">
      @include('inc.contribution_menu')
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px">
            @foreach($drops as $drop)

            <div class="mb-1">

              <img src="{{ $drop->dropType->url }}" class="avatar avatar-sm mr-2" style="width:18px;height:18px"> <a class="h5 text-primary" href="/item/{{ $drop->id }}"> {{ $drop->name }}</a> <button type="button" class="btn btn-outline-warning btn-sm btn-pill ml-4 f-edit" id="{{ $drop->id }}">
  edit
</button><br>
              @if(! is_null($drop->picture))
              <img src="/{{ $drop->picture }}" width="120px" height="120px" class="my-2 rounded">
              <div style="font-size:11px;font-weight:400">@parsedown(nl2br(e($drop->note)))
              </div>
              @endif
            </div>
            @endforeach
          </div>
        </div>

        {{ $drops->links() }}
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit</h5>
      </div>

      {!! form_open_multipart('/contribution/edit',['id'=>'form-modal']) !!}

      <div class="modal-body">

       <div class="dimmer active" id="dimloader">
         <div class="loader"></div>
         <div class="dimmer-content">

           <div class="form-group">
           <div id="previmg"></div>
           </div>

           <div class="form-group">
             <label class="form-label">Nama</label>
             <input type="text" class="form-control form-control-sm" name="name" id="f-name" required>
           </div>


           <div class="form-group">
             <label class="form-label">Picture</label>
             <div id="preview" class="my-1"></div>
             <input type="file" name="picture" id="f-picture" class="form-control form-control-sm" accept="image/*">
             <small class="text-muted">Jika gambar tidak cocok / tidak ada, tambahkan gambar atau kosongkan gambar
              <br> crop sebelum mengupload, rasio gambar 1:1</small>
           </div>

           @csrf
           <input type="hidden" name="id" id="f-id" value="">
         </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save-changes">Save changes</button>
      </div>

      {!! form_close() !!}
    </div>
  </div>
</div>
<!-- //endmodal -->
@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<style type="text/css">
  #nprogress .bar {
    background: red !important;
  }
  #nprogress .peg {
    box-shadow: 0 0 10px red, 0 0 5px red !important;
  }
  #nprogress .spinner-icon {
    border-top-color: red !important;
    border-left-color: red !important;
  }
</style>
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#f-picture").change(function(){
   fileReader(this);
 })
</script>
<script>

$(".f-edit").click(function(e){
  $(this).html("<i class='fa fa-spinner fa-spin'></i>");
      $("#preview").html("");
      $("form")[0].reset();
  	$("#f-picture").val('');

  axios.get('/contribution/fetch/'+this.id)
  .then(res => {
    let data = res.data;

    $("#f-name").val(data.name);
    $("#f-id").val(data.id);

    if(typeof data.picture == 'string'){
      $("#previmg").html(`<img src="/${data.picture}" class="rounded" width="80px" height="80px">`);
    }


    $(".dimmer").removeClass('active');
    $("#exampleModalCenter").modal('show');
  	$(this).html("edit");

  }).catch(err => alert(err));

});
</script>
<script>
$("#form-modal").submit(function(e){
	e.preventDefault();

  let data = new FormData(e.target);
  $("#save-changes").html("<i class='fa fa-spinner fa-spin'></i> saving");

  axios.post('/contribution/edit', data)
  .then(res => {
  	if(res.data.success){
      $("form")[0].reset();
      $("previmg").html("");
      swal('permintaan mengubah dikirim', {
      	icon: 'success'
      }).then(() => {
   		 $("#exampleModalCenter").modal('hide');
      });
    }
  }).catch(err => alert(err))
  .finally(() => {
  	$("#save-changes").html("Save changes");
  })
});
</script>
@endsection