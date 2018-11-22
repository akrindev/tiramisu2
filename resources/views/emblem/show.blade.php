@extends('layouts.tabler')

@section('title', 'Toram List Emblem / Prestasi ' . $emblems->name)
@section('description', 'List of emblems Toram Online, Daftar Prestasi main toram online')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">List Prestasi / Emblem {{ $emblems->name }}</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      @foreach($emblems->child as $emblem)
        <div class="card">
          <div class="card-body p-3">
          <img src="/img/prestasi.png" class="avatar avatar-sm"> <b class="text-primary h5 ml-2">{{ ucfirst($emblem->name) }}</b>
            @if(auth()->check() && auth()->user()->isAdmin())
            <a href="/prestasi/{{ $emblem->id }}/edit" class="btn btn-outline-secondary ml-5 btn-sm">edit</a>
            @endif
            <br>
           <span> {{ $emblem->body }} </span> <br>
           <b>Reward:</b> <i class="text-success"> {{ $emblem->reward }} </i>

          </div>
        </div>
      @endforeach
      </div>
      <div class="col-md-4">
      <div class="card">
        <div class="card-body p-3">
          @foreach((new App\Emblem)->get() as $emb)
          <div class="mb-1">
          <img src="/img/prestasi.png" class="avatar avatar-sm"> <a href="/prestasi/{{ $emb->id }}" class="ml-2">{{ $emb->name }}</a>
          </div>
          @endforeach
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection