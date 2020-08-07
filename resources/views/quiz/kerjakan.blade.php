@extends('layouts.tabler')

@section('title','Toram Quiz')
@section('description','Toram Quiz, Asah otak seberapa dalam kamu tau tentang dunia pertoraman, kuy cek!')
@section('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Toram Online Quiz
      </h1>
    </div>

    <div class="row">

      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Quiz
            </h3>
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <span class="text-success">10</span> Quiz telah di ambil

            <br><br>

            <a href="/quiz/begin" class="btn btn-pill btn-outline-success">Mulai</a>

          </div>

        </div>
      </div>
      <!-- col md 8 -->

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Buat Quizmu sendiri
            </h3>
          </div>
          <div class="card-body p-3" style="font-size:14px;font-weight:400">

            Buat quizmu sendiri, biarkan mereka menjawab quizmu.<br>
            <a href=/quiz/buat class="btn btn-sm btn-pill btn-outline-primary float-right">Buat Quiz!</a>

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