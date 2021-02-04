@extends('layouts.tabler')


@section('title','Fill Stats Formula List')
@section('description','Toram Fillstats Formula full list, Armor, senjata')
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

	  <div class="my-2">
      	@includeUnless(app()->isLocal(), 'inc.ads_article')
      </div>

      <div class="alert alert-info">
          Simulasi Fill Stats <a href="/fill_stats/calculator">Updated</a> <hr class="my-2"/>

          <strong>NEW!!</strong> <br />
          Please Login, so you can give love and automaticaly save the formula
      </div>

        <div class="alert alert-danger">
        	Before using this statting simulator, make sure that you learn these statting skills (3 skills on the bottom) and level up to max level

          <img src="https://lh3.googleusercontent.com/0vK72CbQLCkstI9OuN9hcxbFG5s8vHKt5hAZSwzz0oSkcF58BaFNS4PI9m2C3uxsjXHg-vz_D5fbbxYgK5T3aAvRsZPG0qJFKOnt47pUiyHfVaZ6fhSMlFmRr7KUuUHSKFFXb7AFOQ" class="my-2 d-block" />
          and <b>Max</b> your <b>TECH</b> stats to 255 point.

<img src="https://lh3.googleusercontent.com/LLhAS04wxga6HuLB6Q5pYZvgYdjURvQMLBYvgSYhOWKa5Z6cPiSZ5cDU6PWlmH1Gg68F-e91a0-JN46wruAPAoHPiiKKqo9IRuJsS5BzlBGCyeRJ5Z8c89H8zGbmwUZkuKYP2eW9AA=w1920-h1080" class="my-2 d-block">
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