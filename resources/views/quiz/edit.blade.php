@extends('layouts.tabler')

@section('title','Edit quiz Toram')
@section('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <a href="/quiz/profile" class="btn btn-outline-secondary btn-pill mb-3"><i class="fe fe-chevron-left"></i> Go back </a>
<div class="row">
  <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Edit quiz
            </h3>
          </div>

          @if(session()->has('sukses'))
          <div class="card-alert alert alert-success">
            {{ session('sukses') }} <a href="/quiz/profile">go back</a>
          </div>
          @endif

          {!! form_open() !!}
          <div class="card-body p-3">


            <div class="form-group">
              <label class="form-label">Pertanyaan</label>
              <textarea class="form-control" id="pertanyaan" data-provide="markdown" name="pertanyaan" rows=5 required>{{ $data->question}}</textarea>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban A</label>
              <input type="text" id="jawaban_a" name="jawaban_a" class="form-control" value="{{$data->answer_a}}" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban B</label>
              <input type="text" id="jawaban_b" name="jawaban_b" class="form-control" value="{{$data->answer_b}}" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban C</label>
              <input type="text" id="jawaban_c" name="jawaban_c" class="form-control" value="{{$data->answer_c}}" required>
            </div>


            <div class="form-group">
              <label class="form-label">Jawaban D</label>
              <input type="text" id="jawaban_d" name="jawaban_d" class="form-control" value="{{$data->answer_d}}" required>
            </div>


            <div class="form-group">
              <div class="form-label">
                Jawaban Benar
              </div>
              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="a" class="selectgroup-input" {{$data->correct == 'a' ? 'checked':''}}>
                            <span class="selectgroup-button selectgroup-button-icon">A</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="b" class="selectgroup-input" {{$data->correct == 'b' ? 'checked':''}}>
                            <span class="selectgroup-button selectgroup-button-icon">B</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="c" class="selectgroup-input" {{$data->correct == 'c' ? 'checked':''}}>
                            <span class="selectgroup-button selectgroup-button-icon">C</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="benar" value="d" class="selectgroup-input" {{$data->correct == 'd' ? 'checked':''}}>
                            <span class="selectgroup-button selectgroup-button-icon">D</span>
                 </label>

              </div>
            </div>


            <div class="form-group">
              <button type="submit" class="btn btn-pill btn-outline-primary" id="submitbtn">Ubah</button>
            </div>

          </div>
          @csrf
          {!! form_close() !!}
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

@endsection