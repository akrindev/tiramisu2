@extends('layouts.tabler')

@section('title','Toram Online Wiki')
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

        @include('inc.cari')
        <div>
			<div class="row">

         <div class="col-md-8 mb-5 text-center">
        @includeUnless(app()->isLocal(), 'inc.ads_article')

        	<h1 class="text-center">{{ __('Selamat Datang') }}!</h1>
          <div class="logo text-center mb-5">
          	<img src="/img/logo.png" alt="toram-id.info logo" class="animated pulse infinite" style="height:50%;width:50%">
          </div>
           Jelajahi informasi Toram Online, senjata, armor, drop dan lainnya. <br><br>
           <i class="small">Unofficial site of Toram Online, Fansite Toram online. </i>
           <br>
           <i class="small">Cute logo by <a href="https://facebook.com/rinando.rinando.39" rel="_nofollow">Nurina Laila</a> ^0^ </i> <br>
           <i class="small">In game screenshot is &copy; <u>ASOBIMO,Inc.</u></i>
          </div>

         <div class="col-md-4">
         @include('inc.menu')
         </div>
       </div>
        </div>
      </div>
    </div>

@endsection