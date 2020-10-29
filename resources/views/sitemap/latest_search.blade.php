@extends('layouts.tabler')

@section('title', __('Pencarian Terakhir'))
@section('description', 'Pencarian terakhir, unique search by users')

@section('image', to_img())


@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">{{ __('Pencarian Terakhir') }}</h3>
  </div>

    @include('inc.cari')

    <div class="row">
      <div class="col-md-8">
      	<div class="card">
        <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <h3>Total pencarian: <small class="text-muted"> <a href="/en">{{ $searchTotal }}</a></small> </h3>
          @foreach($searches as $search)
          <a class="tag m-1" href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/search?q={{ str_replace(' ', '+', $search->q) }}"> {{ $search->q }} </a>
          @endforeach


        </div>
      </div>
        {{ $searches->links() }}
      </div>
      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection