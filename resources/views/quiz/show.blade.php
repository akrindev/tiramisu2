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
           Quiz berisi 10 soal diambil secara acak dari setiap quiz yang sudah di submit oleh member<br>
           Tidak ada batasan waktu ketika quiz sedang berlangsung. Quiz hanya untuk mengetes pengetahuanmu tentang toram.<br><br>
            <b>Point</b><br><br>
            Kamu akan mendapat point ketika telah selesai menyelesaikan quiz. point akan di tambahkan otomatis ke jumlah pointmu yang sekarang<br><br>

            jika jawaban benar kurang dari 3 point + 2<br>
                 jika jawaban benar 3-5 point + 5<br>
                 jika jawaban benar 6-8 point + 7<br>
            jika jawaban benar 9-10 point +10
            <br><br>

            <a href="/quiz/mulai" class="btn btn-pill btn-outline-success" onClick="event.preventDefault();mulai()">Mulai quiz</a>

          </div>

        </div>


        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-award"></i> 20 Top Scores
            </h3>

            <div class="card-options">
              <a href="/quiz/score" class="btn btn-sm btn-pill btn-outline-primary">Lihat semua</a>
            </div>
          </div>
          <div class="table-responsive">
          <table class="card-table table table-outline text-nowrap table-vcenter table-striped table-hover" style="font-size:14px;font-weight:400">
            <thead>
              <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th> Nama </th>
                <th> Benar </th>
              <th> Salah </th>
                <th> Point </th>

              </tr>
            </thead>
         @include('inc.top_score_quiz')
          </table>
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
            <a href=/quiz/buat class="btn btn-pill btn-outline-primary float-right mt-4">Buat Quiz!</a>

          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fe fe-activity"></i> Statistik Quiz</h3>
          </div>
          @include('inc.statistik_quiz')
        </div>
      </div>

    </div>

  </div>
</div>
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@guest
<script>
  function mulai()
  {
    swal('Kayaknya kamu harus login dulu deh','','warning');
  }
</script>
@endguest
@auth
<script>
  function mulai()
  {
    swal({
    	title:'Mulai mengerjakan quiz?',
      	text:'',
      	icon:'success',
      	buttons:true,
    })
    .then((gas) => {
      if(gas)
        {
          swal('Oke kita mulai')
          .then(() => {

          setTimeout(function () {
    window.location.href = '/quiz/mulai';
  }, 1500);
          })
        }
      else
        {
          swal('Persiapan dulu gan!');
        }
    });
  }
</script>
@endauth

@endsection