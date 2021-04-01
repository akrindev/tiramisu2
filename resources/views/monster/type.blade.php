@extends('layouts.tabler')

@section('title', 'Toram Online Monster: ' . __(ucfirst($type)))
@section('image', to_img())

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram Online Monster: {{ __(ucfirst($type)) }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>

      <div class="col-md-8">

     @includeUnless(app()->isLocal(), 'inc.ads_article')

     @foreach ($data as $mons)

        @if(($loop->index+1)%5 == 10)
   			@includeUnless(app()->isLocal(), 'inc.ads_article')
        @endif

          @include('inc.drop.monster', $mons)
     @endforeach

      <div class="col-md-8">
        @includeUnless(app()->isLocal(), 'inc.ads_mobile')
      </div>

        <div class="my-3">
        {{ $data->onEachSide(2)->links() }}
        </div>


      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection