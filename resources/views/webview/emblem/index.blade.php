@extends('layouts.webview')

@section('title', 'Toram List Emblem / Prestasi')
@section('description', 'List of emblems Toram Online, Daftar Prestasi main toram online')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Toram List Emblem / Prestasi</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-body p-3">
          @foreach($emblems as $emblem)
          <div class="mb-1">
          <img src="/img/prestasi.png" class="avatar avatar-sm"> <a href="/webview/prestasi/{{ $emblem->id }}" class="ml-2">{{ $emblem->name }}</a>
          </div>
          @endforeach
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection