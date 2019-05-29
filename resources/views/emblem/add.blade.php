@extends('layouts.tabler')

@section('title', 'Tambah data Emblem / Prestasi')
@section('description', 'List of emblems Toram Online, Daftar Prestasi main toram online')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Tambah data prestasi</h3>
  </div>

  <div class="row">
    <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Tambah data</div>
      </div>
      <div class="card-body p-3">

        <form id="add-emblem" method="post">
          @csrf

          <div class="form-group">
            <label class="form-label">Emblem dari</label>               <select name="eid" id="select-emblem" class="form-control custom-select" required>
          @foreach((new \App\Emblem)->get() as $emblem)
            <option value="{{ $emblem->id }}" data-data='{"image": "/img/prestasi.png"}'>{{ $emblem->name }}</option>
          @endforeach
          </select>
          </div>

          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
          </div>


          <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <input type="text" name="body" class="form-control" required>
          </div>


          <div class="form-group">
            <label class="form-label">Reward</label>
            <input type="text" name="reward" class="form-control" required>
          </div>


          <div class="form-group">
            <label class="form-label">Update</label>
            <input type="date" name="update" class="form-control">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-outline-primary" id="tambah">tambah</button>
          </div>

        </form>

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

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
@endsection

@section('footer')
<script type="text/javascript">
  loadProgressBar();
</script>
<script>
   $('#select-emblem').selectize({
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
(function() {
  let form = document.getElementById('add-emblem'),
      btn = document.getElementById("tambah");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target);

    btn.classList.add('btn-loading');

    axios.post('/prestasi/add', data)
    .then(r => {
    	if(r.data.success) {
          swal('Emblem ditambahkan', {
          	icon: 'success'
          }).then(() => {
          	form.reset()
          });
        }
      btn.classList.remove('btn-loading')
    }).catch(e => alert(e));
  });
})();
</script>
@endsection