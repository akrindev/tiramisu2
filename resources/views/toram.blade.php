@extends('layouts.tabler')

@section('title','Toram Online Wiki')
@section('description','Toram Online Database Bahasa Indonesia. Jelajahi data monster, equip, crysta, tools dan berita toram lainnya disini')
@section('image',to_img())



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

  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v12.0&appId=2002599206670692&autoLogAppEvents=1" nonce="uDDFAC1K"></script>


	<div class="my-5">
      <div class="container">

        @include('inc.cari')
        <div>
			<div class="row">

         <div class="col-md-8 mb-5 text-center">
        @includeUnless(app()->isLocal(), 'inc.ads_article')

        	<h1 class="text-center">{{ __('Selamat Datang') }}!</h1>
          <div class="logo text-center mb-5">
          	<img src="/img/logo.png" alt="toram-id.com logo" class="animated pulse infinite" style="height:50%;width:50%">
          </div>
           Jelajahi informasi Toram Online, senjata, armor, drop dan lainnya. <br><br>
           <i class="small">Unofficial site of Toram Online, Fansite Toram online. </i>
           <br>
           <i class="small">Cute logo by <a href="https://facebook.com/rinando.rinando.39" rel="_nofollow">Nurina Laila</a> ^0^ </i> <br>
           <i class="small">In game screenshot is &copy; <u>ASOBIMO,Inc.</u></i>
        @includeUnless(app()->isLocal(), 'inc.ads_mobile')
        <div class="mb-5"></div>
            <div class="mb-5">
                <center><b>Media Partner</b></center>
            </div>
                <div class="fb-page" data-href="https://web.facebook.com/U28Blog" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://web.facebook.com/U28Blog" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/U28Blog">Ultimate Blogger</a></blockquote></div>
          </div>

         <div class="col-md-4">
         @include('inc.menu')
         </div>
       </div>
        </div>
      </div>
    </div>

@endsection
