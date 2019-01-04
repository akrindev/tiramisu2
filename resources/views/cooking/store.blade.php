@extends('layouts.tabler')

@section('title', 'Toram tambah data cooking')

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Tambah data cooking</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-body p-3">

          {!! form_open('/', ['id' => 'cook-form']) !!}
          @csrf

          <div class="form-group">
          <label class="form-label">Nama</label>
           <input type="text" class="form-control" name="nama" required>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Level</label>
            <select name="level" class="form-control" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>


          <div class="form-group">
            <label class="form-label">Pt</label>
            <input type="number" name="pt" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Buff</label>
            <input type="text" name="buff" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Icon</label>

            <div id="preview"></div>

            <div class="custom-file">
              <input type="file" class="custom-file-input mr-5" name="icon" id="icon-img" accept="image/*" required>
              <label class="custom-file-label"></label>
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" id="btn-simpan">Simpan</button>
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

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//unpkg.com/axios/dist/axios.min.js"></script><script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>

    <script type="text/javascript">
        loadProgressBar();
    </script>
@endsection

@section('footer')
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
 $("#icon-img").change(function(){
   fileReader(this);
 })
</script>
<script>
let form = document.getElementById('cook-form');

form.addEventListener('submit', (e) => {
	e.preventDefault();

  	let data = new FormData(e.target),
    	btn = document.getElementById('btn-simpan');

    btn.classList.add('btn-loading');

  	axios.post('/cooking/store', data)
  	.then((res) => {
      btn.classList.remove('btn-loading');

      if(res.data.success) {
        swal('Data telah di tambahkan!!', {
        	icon: 'success'
        }).then(() => {
        	form[0].reset();
        });
      }
    }).catch(e => alert(e));
});
</script>
@endsection