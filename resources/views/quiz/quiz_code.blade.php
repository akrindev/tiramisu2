@extends('layouts.tabler')

@section('title','Toram Kode quiz '.$data->quizCode->code)


@php

$page = request()->page > 1 ? (request()->page-1)*50+1 : 1;
@endphp

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Quiz kode {{ $data->quizCode->code }}</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
          <img src="https://graph.facebook.com/{{$data->quizCode->user->provider_id}}/picture?type=normal" alt="" class="avatar avatar-md mr-2 float-left">
           <strong> <a href="/profile/{{$data->quizCode->user->provider_id}}">{{$data->quizCode->user->name}}</a> </strong> <br> <small class="text-muted"> {{ waktu($data->created_at) }} </small>
            <hr class="my-2">
          {{ $data->body }}

            <br>
            <br>
            <br>
            <a href="/quiz/kode/{{$data->quizCode->code}}/mulai" class="btn btn-outline-primary">Mulai quiz</a>
          </div>
        </div>
      </div>

    </div>


    <div class="row">
      <div class="col-md-12">

        @if(session()->has('gagal'))
        <div class="alert alert-danger"> {{ session('gagal') }} </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-award"></i> Ranking
            </h3>

          </div>
          <div class="table-responsive">
          <table class="card-table table table-outline text-nowrap table-vcenter table-striped table-hover" style="font-size:14px;font-weight:400">
            <thead>
              <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th> Nama </th>
                <th> Benar </th>
              <th> Salah </th>

              </tr>
            </thead>


<tbody>
@forelse ($scores as $score)
   <tr>
     <td class="text-center mr-1 ml-1">
      <div style="background-image: url(https://graph.facebook.com/{{$score->user->provider_id}}/picture?type=normal)" class="avatar d-block"></div></td>
     <td>
       <div> {{ str_limit($score->user->name,20) }}</div>
       <div class="small text-muted">Peringkat {{ $page }} </div>
     </td>
     <td>  <b>{{ $score->benar }}</b>
       <div class="progress progress-xs">
                <div class="progress-bar bg-green" style="width: {{ $score->benar/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>
     <td>
       <b>{{ $score->salah }}</b>
       <div class="progress progress-xs">
                <div class="progress-bar bg-red" style="width: {{ $score->salah/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>

   </tr>
@php $page++; @endphp
  @empty
  <tr class="p-5"><td colspan=3>Belum ada data score</td> </tr>
@endforelse
</tbody>

          </table>
          </div>
        </div>

      </div>

      <div class="col-md-12">
        {{ $scores->links() }}
      </div>
    </div>
  </div>
</div>
@endsection