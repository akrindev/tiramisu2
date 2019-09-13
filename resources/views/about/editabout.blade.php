@extends('layouts.sb-admin')

@section('title','Edit Tentang Kami')
@section('description', $about->body)
@section('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">
<!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Tentang kami</h1>
  </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            {!! form_open('/', ['id' => 'form-about']) !!}
            @csrf
            <div class="form-group">
              <label class="form-label">About Us</label>
              <textarea name="body" rows="10" class="form-control" data-provide="markdown">{{ $about->body }}</textarea>
            </div>

            <div class="form-group">
              <button id="btn-submit" class="btn btn-outline-primary">Submit</button>
            </div>
            {!! form_close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')

 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
<script>
	let submit = document.getElementById('form-about'),
        btnSubmit = document.getElementById("btn-submit");

  submit.addEventListener('submit', (e) => {
  	e.preventDefault();

    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving';
    let data = new FormData(e.target);

    axios.post('/edit-tentang', data)
    .then(res => {
    	if(res.data.success) {
          swal('berhasil mengedit',{
          	icon: 'success'
          });
        }

      btnSubmit.innerHTML = 'simpan';
    }).catch(err => alert(err));
  });
</script>
@endsection