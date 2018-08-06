@extends('layouts.tabler')

@section('content')
  <div class="my-5">
    <div class="container">
    <div class="page-header">
      <h1 class="page-title">Daftar scammer</h1>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah data scammer</h3>
          </div>
          {!! form_open_multipart('/scammer/tambah',["id"=>"scammedr-catcher"]) !!}
          @csrf
          <div class="card-body p-3">

            <div class="form-group">
              <label class="form-label">Apa yang di scam?</label>
              <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group">
              <label class="form-label">Kategori</label>
              <select name="kategori" id="kategori" class="form-control" required>
                @foreach($kat as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Kasus</label>
              <textarea name="kasus" rows="10" class="form-control" required></textarea>
              <small class="text-muted">ceritakan alur kejadian dengan jelas</small>
            </div>

            <div class="form-group">
             <label class="form-label">facebook scammer</label>
              <input type="text" name="facebook" class="form-control">
            </div>

            <div class="form-group">
                  <label class="form-label">line scammer</label>
              <input type="text" name="line" class="form-control">
            </div>

            <div class="form-group">
                    <label class="form-label">ign toram scammer</label>
              <input type="text" name="ign" class="form-control">
            </div>

            <div class="form-group">
              <label class="form-label">Kerugian </label>
              <input type="text" name="spina" class="form-control">
              <small class="text-muted">dalam bentuk spina</small>
            </div>

            <div class="form-group">
  <label class="form-label">Screenshots bukti</label>
  <input id='file-input' class="form-control" name="gambar[]" type='file' accept="image/*" multiple/>
              <small class="text-muted">tandai semua screenshots bukti</small>


<div id='file-list-display'></div>
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary" type="submit" id="kirim">kirim</button>
            </div>

          </div>
          {!! form_close() !!}
        </div>
      </div>
    </div>
      </div>
  </div>
@endsection

@section('footer')
<script>
(function () {
  "use strict";

	let fileCatcher = document.getElementById('scammer-catcher');
  	let fileInput = document.getElementById('file-input');
  	let fileListDisplay = document.getElementById('file-list-display');



  	let fileList = [];
  	let renderFileList, sendFile;

  fileInput.addEventListener('change', (evnt) => {
 	fileList = [];
	fileListDisplay.innerHTML = '';
  	fileListDisplay.innerHTML = '<table class="table table-striped">';
  	for (let i = 0; i < fileInput.files.length; i++) {

      fileList.push(fileInput.files[i]);

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

	  let data = new FormData(),
          request;

    	data.append('file', fileList);

    	request = new XMLHttpRequest();
    	request.upload.addEventListener('progress', function(e) {
    	var percent_complete = (e.loaded / e.total)*100;

    	document.querySelector('#kirim').innerText = 'kirim '+percent_complete+' %';
    });
    request.responseType = 'json';
    request.open('post', '/scammer/tambah');
    request.send(data);
});
})();
</script>
@endsection