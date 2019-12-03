@extends('layouts.tabler')


@section('title','Toram Fillstats Formula +18, +19, +20 full list')
@section('description','Toram Fillstats Formula full list, Armor, senjata +18, +19, +20 dst')
@section('image',to_img())


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-3 my-md-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Fill Stats Formula</h1>
    </div>
     @include('inc.cari')

    <div class="row" id="filler">

      <div class="col-12">
        @includeWhen(!app()->isLocal(), 'inc.ads_article')
      </div>

      <div class="col-12">
                <div class="alert alert-info">
                  <b>New!!</b> Fill stats calculator <a href="/fill_stats/calculator">Klik disini</a>
                </div>
              </div>
      <div class="col-12 my-5">
 @foreach($fills as $fo)
         <a href="/fill_stats/{{ $fo->type == 1 ? 'Armor':'Weapon'  }}/{{ $fo->plus }}" class="btn btn-sm btn-pill btn-secondary" onclick="event.preventDefault();document.getElementById('{{ $fo->type == 1 ? 'armor':'weapon'  }}{{ "+$fo->plus" }}').scrollIntoView();">
                  {{ $fo->type == 1 ? 'Armor':'Weapon'  }}{{ " (+$fo->plus)" }}</a>
 @endforeach

        <div class="m-3 text-center">
          <small class="text-muted">Terdapat {{ $data->count() }} formula </small>
        </div>
       </div>
      <div id="filload" class="col-12 text-center">
        <span class="h1 text-center">
      	<i class="fa fa-spinner fa-spin"></i> loading...
        </span>
        <small id="cd" class="text-muted d-block"></small>
        <script>
          var c = 20;
          var s;

          s = setInterval(function(){

          $("#cd").html(c + ' detik');
          c--;

          if(c < 0) {
            clearInterval(s);
            $("#cd").html('internet terlalu lambat!<br>Tunggu... halaman akan segera dimuat!!')
           }
          }, 1000);
        </script>
      </div>

  @foreach($fills as $fl)

      <div class="col-12">
        <h1 class="page-title" id="{{ $fl->type == 1 ? 'armor':'weapon'  }}{{ "+$fl->plus" }}">
          {{ $fl->type == 1 ? 'Armor':'Weapon'  }}{{ " (+$fl->plus)" }}
        </h1>
      </div>

   	@foreach($data as $pos)

         @if($pos->type == $fl->type && $pos->plus == $fl->plus)
              <div class="col-md-6 col-xl-4">
                <div class="card card-collapsed">
                  <div class="card-status card-status-left bg-blue"></div>
                  <div class="card-header">
                    <h6 class="card-title">{{ e($pos->stats) }}</h6>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>

                    </div>
                  </div>
                  <div class="card-body">
                 {!! nl2br(e($pos->steps)) !!}
                  </div>

			@if(Auth::check() && Auth::user()->isAdmin())
                  <div class="card-footer">
                    <a href="/edit/{{ $pos->id }}/fillstats" class="btn btn-primary">edit</a>
                  </div>
            @endif

                </div>
              </div>
    	 @endif
	@endforeach

   @endforeach

      <div class="col-12">
        @includeWhen(!app()->isLocal(), 'inc.ads_article')
      </div>
    </div>

  </div>
</div>
<button class="btn btn-md btn-primary" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fe fe-arrow-up mr-2"></i>Ke Atas</button>
<style>
  #myBtn {
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 70px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
 /* border: none; /* Remove borders */
  /*outline: none; /* Remove outline */
 /* background-color: red; /* Set a background color */
 /* color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
 /* padding: 15px; /* Some padding */
/*  border-radius: 10px; /* Rounded corners */
 /* font-size: 18px; /* Increase font size */
}

</style>
@endsection

@section('head')
<script>
  $('#filler').ready(function() {
 	$("#filload").remove();
  });

  window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
@endsection