@extends('layouts.tabler')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Edit data</h1>
    </div>


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah data scammer</h3>
          </div>
          {!! form_open_multipart('/scammer/'.$scam->slug.'/edit',["id"=>"scammer-catcher"]) !!}
          @csrf
          <div class="card-body p-3">

            <div class="form-group">
              <label class="form-label">Apa yang di scam?</label>
              <input type="text" name="judul" class="form-control" value="{{$scam->judul}}" required>
            </div>

            <div class="form-group">
              <label class="form-label">Kategori</label>
              <select name="kategori" id="kategori" class="form-control" required>
                @foreach($kat as $cat)
                <option value="{{$cat->id}}" {{ $scam->cat_scammer_id == $cat->id ? 'selected':''}}>{{$cat->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Kasus</label>
              <textarea name="kasus" rows="10" class="form-control" required>{{$scam->body}}</textarea>
              <small class="text-muted">ceritakan alur kejadian dengan jelas</small>
            </div>

            <div class="form-group">
             <label class="form-label">facebook scammer</label>
              <input type="text" name="facebook" class="form-control" value="{{$scam->facebook}}">
            </div>

            <div class="form-group">
                  <label class="form-label">line scammer</label>
              <input type="text" name="line" class="form-control" value="{{$scam->line}}">
            </div>

            <div class="form-group">
                    <label class="form-label">ign toram scammer</label>
              <input type="text" name="ign" class="form-control" value="{{$scam->ign}}">
            </div>

            <div class="form-group">
              <label class="form-label">Kerugian </label>
              <input type="text" name="spina" class="form-control" value="{{$scam->spina}}">
              <small class="text-muted">dalam bentuk spina</small>
            </div>

            <div class="form-group">

  <label class="form-label">Screenshots bukti</label>

              <small class="text-muted">Tap untuk menghapus</small>
              <div class="my-5">
          @foreach ($scam->picture as $img)
           <img src="{{$img->url}}" class="gambar-bukti img-thumbnail" style="max-width:30%" data-id="{{$img->id}}">
          @endforeach
             </div>
  <input id='file-input' class="form-control" name="gambar[]" type='file' accept="image/*" multiple/>
              <small class="text-muted">tandai semua screenshots bukti</small>


<div id='file-list-display'></div>
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary" type="submit" id="kirim">kirim</button>
              <span class="btn btn-outline-danger" id="hapus-ini" data-id="{{$scam->id}}">Hapus</span>
            </div>

          </div>
          {!! form_close() !!}
        </div>
      </div>
    </div>

  </div>
</div>
@endsection


@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
<script>

(function () {
  "use strict";

	let fileCatcher = document.getElementById('scammer-catcher');
  	let fileInput = document.getElementById('file-input');
  	let fileListDisplay = document.getElementById('file-list-display');

  	let hapusBukti = document.querySelectorAll('.gambar-bukti');

  	let hapusData = document.getElementById('hapus-ini');


  	let fileList = new FormData();
  	let renderFileList, sendFile;

  	let postTo = '/scammer/{{$scam->slug}}/edit';
  	let token = '{{ csrf_token() }}';

  hapusData.addEventListener('click', (e) => {
 // 	e.preventDefault();
    let theData = new FormData(e.target);
    theData.append('_token', token);
    theData.append('_method', 'DELETE');
    theData.append('id', hapusData.getAttribute('data-id'));
    swal({
    	title: 'Yakin mau hapus post ini?',
      	text: '',
      	icon: 'warning',
      	buttons: true,
      	dangerMode: true
    }).then((wD) => {
    	if(wD) {
          axios.post('/scammer/delete', theData)
          	.then((the) => {
          		if(the.data.sukses) {
                  swal("Data berhasil di hapus", {
                  	icon: 'success'
                  }).then(() => {
                  	window.location.href = '/scammer';
                  });
                }
          	})
          	.catch((err) => alert(err));
        } else {
          swal("Oke gan aman!");
        }
    })
  });

  for(let aku of hapusBukti) {
    aku.addEventListener('click', (e) => {

      let d = new FormData(e.target);
      d.append('_token', token);
      d.append('id', aku.getAttribute('data-id'));

      swal({
        title: 'Yakin mau hapus bukti ini?',
        text: '',
        icon: 'warning',
        buttons: true,
        dangerMode: true
      }).then((hapus) => {
        if (hapus) {
          axios.post('/scammer/img', d)
          .then((r) => {
            if(r.data.sukses) {
          		swal("Berhasil di hapus", {
            		icon: 'success'
            	}).then(() => {
                  aku.remove();
                })

            } else {
              	swal("Gagal menghapus", {
                	icon: 'error'
                });
            }
          }).catch(err => alert(err));
        } else {
          swal("Oke gan aman!");
        }
      })
    });
  }

  fileInput.addEventListener('change', (evnt) => {
	fileListDisplay.innerHTML = '';
  	fileListDisplay.innerHTML = '<table class="table table-striped">';
  	for (let i = 0; i < fileInput.files.length; i++) {

      fileList.append('gambar['+i+']',fileInput.files[i]);

      	let reader = new FileReader();

        reader.onloadend = (e) => {
  			fileListDisplay.innerHTML += '<img style="max-width:30%;" src="'+e.target.result+'" class="img-thumbnail mr-2">';

        }
      reader.readAsDataURL(fileInput.files[i]);

    }

  	fileListDisplay.innerHTML += '</table>';

  });


	fileCatcher.addEventListener('submit', (event) => {
      event.preventDefault();

	  fileList = new FormData(event.target);
		document.querySelector("#kirim")
        	.innerHTML = '<i class="fa fa-spinner fa-spin"></i> mengirim ';
      axios.post(postTo, fileList)
        .then((r) => {
      		window.location.href = '/scammer/r/'+r.data.redirect;
      	}).catch((err) => {
       		alert(err);
      	});
});
})();
</script>
@endsection