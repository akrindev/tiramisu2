@extends('layouts.tabler')

@section('title','Toram online database dan komunitas indonesia')
@section('description','Toram Online database dan komunitas indonesia, jelajahi data monster, equip, crysta dan berita lainnya disini')
@section('image',to_img())


@section('content')

        <div class="my-8">
          <div class="container">
  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

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

      </div>
    </div>

@endsection