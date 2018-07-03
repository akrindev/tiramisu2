@extends('layouts.tabler')

@section('title','Toram online database dan komunitas indonesia')
@section('description','Toram Online database dan komunitas indonesia, jelajahi data monster, equip, crysta dan berita lainnya disini')
@section('image',to_img())


@section('content')

        <div class="my-3 my-md-5">
          <div class="container">

            @include('inc.cari')

        <h1>Selamat datang!</h1>

        Jelajahi informasi Toram Online, senjata, armor, drop dan lainnya. Unofficial site Toram, Fansite Toram online.
       <hr>



      @if(session('sukses'))
                  <div class="card-alert alert alert-success mb-0">
                    {{ session('sukses') }}
                  </div>
            <hr>
      @endif


      @if(session('gagal'))
                  <div class="card-alert alert alert-danger mb-0">
                    {{ session('gagal') }}
                  </div>
            <hr>
      @endif

            @if(Auth::check() && Auth::user()->role == 'admin')

                    <a href="/store-equip" class="btn btn-secondary">Tambah data equip</a>
                    <a href="/store-mob" class="btn btn-secondary">Tambah data monster</a>
                    <a href="/store-crysta" class="btn btn-secondary">Tambah data crysta</a>

                    <a href="/fill_stats/add" class="btn btn-secondary">Tambah data fill stats</a>
             @endif
      </div>
    </div>

@endsection