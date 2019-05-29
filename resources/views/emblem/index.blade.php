@extends('layouts.tabler')

@section('title', 'Toram List Prestasi (emblem)')
@section('description', 'List of emblems Toram Online, Daftar Prestasi Toram online')
@section('image', to_img())

@section('content')

    @if(session('sukses'))
      <div class="card-alert alert alert-success mb-0">
         {{ session('sukses') }}
      </div>
    @endif
    @if(session('gagal'))
      <div class="card-alert alert alert-danger mb-0">
         {{ session('gagal') }}
      </div>
    @endif

<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Toram List Emblem / Prestasi</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-alert alert alert-info">
Cara melihat prestasi. <br> "Menu" &gt; "Karakter" &gt; "Prestasi"
        </div>
        <div class="card-body p-3">
          <div class="mb-5">
          <b>Tampilkan reward: </b> <a href="/prestasi/reward/orb">Orb</a>, <a href="/prestasi/reward/karcis kostum">Karcis Kostum</a>, <a href="/prestasi/reward/stat point">Stat Point</a>, <a href="/prestasi/reward/skill point">Skill Point</a>, <a href="/prestasi/reward/exp gain">EXP Gain</a>, <a href="/prestasi/reward/spina">Spina</a>
          </div>
          @foreach($emblems as $emblem)
          <div class="mb-1">
          <img src="/img/prestasi.png" class="avatar avatar-sm"> <a href="/prestasi/{{ $emblem->id }}" class="ml-2">{{ $emblem->name }}</a>
          </div>
          @endforeach
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection