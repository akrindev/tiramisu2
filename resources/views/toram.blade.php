@extends('layouts.tabler')

@section('title','Toram Online Database Bahasa Indonesia')
@section('description','Toram Online Database Bahasa Indonesia. Jelajahi data monster, equip, crysta, tools dan berita toram lainnya disini')
@section('image',to_img())

@push('canonical')
	@canonical
@endpush

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

        @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')

        @include('inc.cari')

        <h1>Selamat datang!</h1>

		<div class="row">

         <div class="col-md-8 mb-5"> Jelajahi informasi Toram Online, senjata, armor, drop dan lainnya. <br>
           <i class="small">Unofficial site Toram Online, Fansite Toram online. </i>
           <br>
           <i class="small">In game screenshot is &copy; <u>ASOBIMO,Inc.</u></i>
          </div>

         <div class="col-md-4">
         @include('inc.menu')
         </div>
       </div>

      </div>
    </div>

@endsection