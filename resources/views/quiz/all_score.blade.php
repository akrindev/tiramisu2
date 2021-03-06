@extends('layouts.tabler')

@section('title','Top score quiz')

@php

$page = request()->page > 1 ? (request()->page-1)*50+1 : 1;
@endphp

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Ranking Quiz</h1>
    </div>
    <div class="row">
      <div class="col-md-12">

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
                <th> Point </th>

              </tr>
            </thead>


<tbody>
@foreach ($scores as $score)
   <tr>
     <td class="text-center mr-1 ml-1">
      <div style="background-image: url({{ $score->user->getAvatar() }})" class="avatar d-block"></div></td>
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
     <td>
       <div>{{ $score->point }}</div>
       <small class="text-muted">Last seen: {{ $score->updated_at->diffForHumans() }}</small>
       <div class="progress progress-xs">
                <div class="progress-bar bg-primary" style="width: {{ $score->point/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>

   </tr>
@php $page++; @endphp
@endforeach
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