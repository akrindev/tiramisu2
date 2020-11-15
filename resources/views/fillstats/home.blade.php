@extends('layouts.tabler')


@section('title','Toram Fillstats Formula +20, +21 full list')
@section('description','Toram Fillstats Formula full list, Armor, senjata +20, +21 dst')
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

      <div class="alert alert-info">
          Simulasi Fill Stats <a href="/fill_stats/calculator">Updated</a> <br />

          <strong>NEW!!</strong> <br />
          if you login, you can give love and automaticaly save the formula
      </div>

       <div class="my-2">
      	@includeUnless(app()->isLocal(), 'inc.ads_article')
      </div>

      	<livewire:formula />

       <div class="mt-2">
      	@includeUnless(app()->isLocal(), 'inc.ads_mobile')
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
	@livewireStyles
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

@section('footer')
	@livewireScripts
@endsection