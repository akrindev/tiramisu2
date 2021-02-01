@extends('layouts.tabler')

@section('title', 'Registlet Gem Case')
@section('description', 'List of Registlet Gem Case atau Kartrid Permata')

@section('content')
<div class="my-5">
  <div class="container">

  <div class="page-header">
    <h3 class="page-title">Registlet Gem Case List</h3>
  </div>

	  <div class="row">

		  <div class="col-md-8">

			  <livewire:registled.show />

		  </div>

		  <div class="col-md-4">
		  	@include('inc.menu')
		  </div>


	  </div>

  </div>
</div>

@endsection

@section('head')
	@livewireStyles
@endsection

@section('footer')
	@livewireScripts
@endsection