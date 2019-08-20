@extends('layouts.tabler')

@section('title','Toram Background Music list')
@section('description','Toram online background music list download or play online')
@section('image',to_img())

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Toram online Background Music </h1>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div class="alert alert-info">
              Reload jika terjadi error
            </div>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

            @foreach ($musics as $bgm)
            <i class="fe fe-headphones"></i> <a href="/bgm/{{ $bgm->slug }}"> {{ $bgm->title }} </a><br />
            @endforeach
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection