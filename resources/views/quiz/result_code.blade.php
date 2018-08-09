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

          </div>
            <div class="form-group mt-3">
              <a href="/quiz" class="btn btn-outline-success float-right"> Ke quiz </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection