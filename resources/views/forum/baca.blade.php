@extends('layouts.tabler')

@section('content')

@php
$tags = $data->tags;
$tags = explode(',', $tags);
@endphp
<style>

  p.body-text, div.body-text {
     -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size:13px;
    font-family:'Source Sans Pro';
    font-weight:400;
  }
</style>

        <div class="my-3 my-md-5">
          <div class="container">

<div class="row">
 <div class="col-md-8">

   <a href="/forum" class="btn btn-sm mb-3 btn-outline-secondary btn-pill"> &lt; Back to forum</a>

   <div class="mb-3">

            <h4 class="mt0 mb-0"> {{ $data->judul }} </h4>
   </div>

        <div class="card p-0">
          <div class="card-status bg-{{ $data->color }}"></div>

          <div class="card-body text-wrap p-3">

     <img src="https://graph.facebook.com/{{$data->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4"> <b> {{ $data->user->name }} </b><br> <small> on {{ waktu($data->created_at) }} </small>
            <hr class="my-2">
            <div class="my-1">
              @foreach ($tags as $tag => $n)
              <a class="tag"> {{ $n }} </a>
              @endforeach
            </div>
            <div class="body-text">
            @parsedown($data->body)
            </div>
          </div>
        </div>
@for ($a=10; $a > 0;$a-- )
		<div class="card p-0">
          <div class="card-body p-3">
            <img src="/img/potum.gif" class="avatar avatar-md float-left mr-4">
            <b> Akrin Min </b> <br>
            <small class="text-muted">22 agustus 1998 22:10</small>
            <hr class="my-2">
            <p class="body-text">
            Yang ku harapkan hanyalah kamu ehehehehehehe
            <br>
            INT untuk menambah MATK dan juga mp
DEX reduce casting time, jika kamu masih lv 180± dan dex dibawah 200 maka nemesis masih lambat casting
VIT untuk HP dan DEF
            </p>
            <a href="#" class="btn btn-sm btn-pill btn-outline-primary float-right">balas</a>
          </div>
   		</div>

@endfor


		<div class="card p-0">
          <div class="card-body p-3">
            <img src="/img/potum.gif" class="avatar avatar-md float-left mr-4">
            <b> Akrin Min </b> <br>
            <small class="text-muted">22 agustus 1998 22:10</small>
            <hr class="my-2">

            <textarea class="form-control" rows=5></textarea>
            <small class="text-muted">Markdown supported</small>
            <button class="btn btn-pill btn-outline-primary float-right my-3">balas </button>
          </div>
   		</div>
  </div>


              <div class="col-md-4">

                <!-- tags -->

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      Berdasarkan Tags
                    </h3>
                  </div>
                    <div class="p-0 m-0">

                      @include('inc.tags')

                    </div>

                </div>
                <!-- // tags -->

              </div>

            </div>
          </div>
        </div>

@endsection