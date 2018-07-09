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
@auth
          {!! form_open('/quiz/buat',['id'=>'tambah-quiz']) !!}
          <div class="card-body p-3">


            <div class="form-group">
              <label class="form-label">Pertanyaan</label>
              <textarea class="form-control" id="pertanyaan" data-provide="markdown" name="pertanyaan" rows=5 required></textarea>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban A</label>
              <input type="text" id="jawaban_a" name="jawaban_a" class="form-control" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban B</label>
              <input type="text" id="jawaban_b" name="jawaban_b" class="form-control" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban C</label>
              <input type="text" id="jawaban_c" name="jawaban_c" class="form-control" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban D</label>
              <input type="text" id="jawaban_d" name="jawaban_d" class="form-control" required>
            </div>


            <div class="form-group">
              <div class="form-label">
                Jawaban Benar
              </div>
              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="a" class="selectgroup-input" checked="">
                            <span class="selectgroup-button selectgroup-button-icon">A</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="b" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">B</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="c" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">C</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="d" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">D</span>
                 </label>

              </div>
            </div>


            <div class="form-group">
              <button type="submit" class="btn btn-pill btn-outline-primary" id="submitbtn">kirim</button>
            </div>

          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfp">
          {!! form_close() !!}
@else
          <div class="card-body">
            <strong>Upss!! akses <a href="/fb-login">Login</a> dibutuhkan untuk menambah quiz</strong>
          </div>
@endauth
        </div>
      </div>
      <!-- col md 8 -->

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Peraturan membuat quiz
            </h3>
          </div>
          <div class="card-body p-3">
            - Quiz masih bersangkutan dengan Toram.<br>
            - Quiz tidak merendahkan orang, agama atau organisasi.<br>
            - Berbahasa sopan<br>
            - Tidak mengandung unsur <b>Pornografi</b><br>
            - INGAT untuk mengoreksi sebelum mengirim quiz<br>
            - Isi semua data yang di butuhkan, tidak boleh kosong<br>

          </div>
        </div>
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

@endsection