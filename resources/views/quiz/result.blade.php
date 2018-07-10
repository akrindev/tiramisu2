@extends('layouts.tabler')

@section('title','Hasil quiz')

@section('content')
<div class="my-5">
  <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Hasil quiz</h1>
    </div>

    <div class="row">

      <div class="col-md-7">
        <div class="card">
          <div class="card-body p-4" style="font-size:14px;font-weight:400">

            <div class="mb-4">
            <b>Benar {{ $benar }} / 10 </b><br>
             <div class="progress progress-sm">
                <div class="progress-bar bg-green" style="width: {{ $benar/10*100 }}%"></div>
             </div>

            <b>Salah {{ $salah }} / 10</b><br>
             <div class="progress progress-sm">
                <div class="progress-bar bg-red" style="width: {{ $salah/10*100 }}%"></div>
             </div>

            <b>Point {{ $point }}</b><br>
             <div class="progress progress-sm">
                <div class="progress-bar bg-blue" style="width: {{ $point/10*100 }}%"></div>
             </div>

          </div>
            <div class="form-group mt-3">
              <a href="/quiz/mulai" class="btn btn-outline-primary"> Mulai lagi </a>
              <a href="/quiz/baru" class="btn btn-outline-secondary"> Buat quiz </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Scoreku
            </h3>
          </div>
          <table class="card-table table table-striped">
            <thead>
              <tr>
                <th> Benar </th>
                <th> Salah </th>
                <th> Point </th>
              </tr>
            </thead>
            <tr>
              <td class="text-success"> {{ auth()->user()->quizScore->benar }} </td>
                       <td class="text-danger"> {{ auth()->user()->quizScore->salah }} </td>
                       <td class=""> {{ auth()->user()->quizScore->point }} </td>
            </tr>
          </table>
        </div>

      </div>

    </div>

  </div>
</div>
@endsection