@extends('layouts.tabler')

@section('title', $data->name . ' (Lv '. $data->level .')')
@section('image', !is_null($data->picture) ? '/'.$data->picture : to_img())


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h1 class="page-title">{{ $data->name }}</h1>
  </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>
      <div class="col-md-8">

   @includeUnless(app()->isLocal(), 'inc.ads_article')

          @include('inc.drop.monster', $mons = $data)
      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection