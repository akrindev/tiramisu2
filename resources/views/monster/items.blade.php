@extends('layouts.tabler')

@section('title', 'Toram database ' . $type->name)
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
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">

            @forelse($data as $item)
            <div class="mb-5">
              <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="max-width:21px;max-height:21px">
              <b class="h6"><a class="text-primary" href="/item/{{ $item->id }}">{{ $item->name }}</a></b>
           @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif

            @if(! is_null($item->note))
              <div class="my-1 ml-5" style="font-size:11px;font-weight:350">
                @parsedown(nl2br(e($item->note)))
              </div>
            @endif
            </div>
            @empty
            <div class="h5">Tidak di temukan</div>
            @endforelse

          </div>
        </div>
      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>

</div>
@endsection