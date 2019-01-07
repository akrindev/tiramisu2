@extends('layouts.tabler')

@section('title', 'Toram drop list ' . $type->name)
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram {{ $type->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
        @include('inc.cari')
      </div>
      <div class="col-md-8">

   @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')

       @forelse($data as $item)
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <div>
              <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="max-width:21px;max-height:21px">
              <b class="h6"><a class="text-primary" href="/item/{{ $item->id }}">{{ $item->name }}</a></b>
           @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif

            <div class="row">
            @if(! is_null($item->picture))
              <div class="col-md-3">
              <img src="/img/ball-triangle.svg" data-src="/{{ $item->picture }}" class="rounded my-2 d-block lazyload" width="170px" height="170px"> </div>
            @endif

            @if(! is_null($item->note))
              <div class="col-md-9 my-1">
                @parsedown(nl2br(e($item->note)))
              </div>
            @endif
             </div>

            </div>
          </div>
        </div>
       @empty
            <div class="h5">Tidak di temukan</div>
       @endforelse

        {{ $data->links() }}
      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>

</div>
@endsection