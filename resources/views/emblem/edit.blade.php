@extends('layouts.tabler')

@section('title', 'Edit data Emblem / Prestasi')
@section('description', 'List of emblems Toram Online, Daftar Prestasi main toram online')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Edit data prestasi</h3>
  </div>

  <div class="row">
    <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Edit data</div>
      </div>
      <div class="card-body p-3">

        <form id="adit-emblem" method="post" action="/prestasi/{{ $emb->id }}/edit">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label class="form-label">Emblem dari</label>               <select name="eid" id="select-emblem" class="form-control custom-select" required>
          @foreach((new \App\Emblem)->get() as $emblem)
            <option value="{{ $emblem->id }}" data-data='{"image": "/img/prestasi.png"}' {{ $emb->emblem_id == $emblem->id ? 'selected' : ''}}>{{ $emblem->name }}</option>
          @endforeach
          </select>
          </div>

          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $emb->name }}" required>
          </div>


          <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <input type="text" name="body" class="form-control" value="{{ $emb->body }}" required>
          </div>


          <div class="form-group">
            <label class="form-label">Reward</label>
            <input type="text" name="reward" class="form-control" value="{{ $emb->reward }}" required>
          </div>


          <div class="form-group">
            <label class="form-label">Update</label>
            <input type="date" name="update" class="form-control" value="{{ $emb->update }}">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-outline-primary" id="tambah">Ubah</button> <button class="btn btn-outline-danger" id="hapus">Hapus</button>
          </div>

        </form>


        <form id="hapus-emblem" method="post" action="/prestasi/{{ $emb->id }}/hapus">
          @csrf
          @method('DELETE')
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
  let form = document.getElementById('adit-emblem'),
      del = document.getElementById('hapus-emblem'),
      btn = document.getElementById("tambah"),
      hapus = document.getElementById('hapus');

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target),
        sendTo = form.getAttribute('action');

    btn.classList.add('btn-loading');

    axios.post(sendTo, data)
    .then(r => {
    	if(r.data.success) {
          swal('Emblem diedit', {
          	icon: 'success'
          }).then(() => {
          	form.reset()

            window.location.href = '/prestasi/' + r.data.id
          });
        }
      btn.classList.remove('btn-loading')
    }).catch(e => alert(e));
  });

  hapus.addEventListener('click', (e) => {
  	e.preventDefault();

    swal({
    	title: 'Hapus data ini?',
      	text: 'Data akan di hapus permanen!',
      	icon: 'warning',
      	buttons: true
    }).then(r => {
    	if(r) {
          del.submit();
        }
    }).catch(e => alert(e));

  });
})();
</script>
@endsection