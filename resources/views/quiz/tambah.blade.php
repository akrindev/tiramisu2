@extends('layouts.tabler')

@section('title','Buat quiz Toram')
@section('description','Buat quiz toram sendiri')
@section('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Buat quiz toram
      </h1>
    </div>

    <div class="row">

      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Buat quiz
            </h3>
          </div>

          {!! form_open_multipart('/quiz/buat',['id'=>'tambah-quiz']) !!}
          <div class="card-body p-3">

            <div class="form-group">
              <label class="form-label"> Gambar</label>
              <div id="preview"></div>
             <div class="custom-file">
               <input type="file" class="custom-file-input mr-5" name="gambar" id="gambar" accept="image/*">
              <label class="custom-file-label">Pilih gambar</label>
             </div>
              <small class="text-muted">Optional (jika menggunakan gambar)</small>
            </div>


            <div class="form-group">
              <label class="form-label">Pertanyaan</label>
              <textarea class="form-control" data-provide="markdown" name="pertanyaan" rows=5></textarea>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban A</label>
              <input type="text" name="jawaban_a" class="form-control" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban B</label>
              <input type="text" name="jawaban_a" class="form-control" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban C</label>
              <input type="text" name="jawaban_a" class="form-control" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban D</label>
              <input type="text" name="jawaban_a" class="form-control" required>
            </div>


            <div class="form-group">
              <div class="form-label">
                Jawaban Benar
              </div>
              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="icon-input" value="a" class="selectgroup-input" checked="">
                            <span class="selectgroup-button selectgroup-button-icon">A</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="icon-input" value="b" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">B</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="icon-input" value="c" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">C</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="icon-input" value="d" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">D</span>
                 </label>

              </div>
            </div>


            <div class="form-group">
              <small class="btnku text-muted">...</small>
              <button type="submit" class="btn btn-pill btn-outline-primary" id="submitbtn">kirim</button>
            </div>

          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfp">
          {!! form_close() !!}
        </div>
      </div>
      <!-- col md 8 -->

      <div class="col-md-4">
      </div>

    </div>

  </div>
</div>
@endsection

@section('footer')
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/quiz.js"></script>

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