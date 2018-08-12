@extends('layouts.tabler')

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Buat kode quiz</h3>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body p-3">

      Pilih quiz untuk di tampilkan sebagai soal <br>
      <br>

          <span class="btn btn-outline-primary" disabled="" onClick="document.getElementById('buatKodeKu').submit();event.preventDefault();">buat kode</span>


        </div>
      </div>
    </div>
    <div class="col-md-12">


      @if(session('sukses'))
       <div class="alert alert-success">{!! session('sukses') !!}</div>
      @endif

      @if(session('gagal'))
       <div class="alert alert-danger">{{ session('gagal') }}</div>
      @endif

      @if($errors->has('terpilih'))
      <div class="alert alert-danger">{{ $errors->first('terpilih') }}</div>
      @endif

{!! form_open('/quiz/buat-kode',["id"=>"buatKodeKu"]) !!}
      @csrf

      <div class="card">
        <div class="card-body p-3">
          <div class="form-group">
            <label class="form-label">Deskripsi kode</label>
            <textarea name="body" id="" rows="5" class="form-control"></textarea>

      @if($errors->has('body'))
       <div class="text-danger">{{ $errors->first('body') }}</div>
      @endif
          </div>
        </div>
      </div>

      @foreach($kuis as $quiz)
      <div class="card">
        <div class="card-body p-3" style="font-weight:400;font-size:14px">
          <div class="my-2">       <label class="custom-switch">
                          <input type="checkbox" name="terpilih[]" value="{{$quiz->id}}" class="custom-switch-input">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">pilih</span>
                        </label></div>
        @parsedown($quiz->question) <br><br>
          <strong>a:</strong> {{ $quiz->answer_a }} <br>
          <strong>b:</strong> {{ $quiz->answer_b }} <br>
          <strong>c:</strong> {{ $quiz->answer_c }} <br>
          <strong>d:</strong> {{ $quiz->answer_d }} <br><br>
          <strong>correct:</strong> {{ $quiz->correct }} <br>
        </div>
      </div>

      @endforeach
{!! form_close() !!}
    </div>
  </div>
</div>
</div>
@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
@endsection

@section('footer')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
@endsection