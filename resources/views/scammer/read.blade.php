@extends('layouts.tabler')

@section('title',$data->judul)

@section('content')
<div class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">


   <a href="/scammer" class="btn btn-sm mb-3 btn-outline-secondary btn-pill"> <i class="fe fe-chevrons-left"></i> Back to scammers list</a>

        <div class="my-3">
          <h4 class="mb-0">{{ $data->judul }} </h4>
        </div>
        <div class="card">
          <div class="card-status bg-primary"></div>
          <div class="card-body p-3" style="font-size:13px;font-weight:400;">

     <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="https://graph.facebook.com/{{$data->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4 lazyload"><a href="/profile/{{$data->user->provider_id }}" data-author="{{ $data->user->name }}"> <b> {{ $data->user->name }} </b></a><br>
            <small class="text-muted"> {{ waktu($data->created_at) }} &nbsp; <i class="fe fe-message-square"></i> {{ $data->comment->count() }} </small>

            @if(auth()->check() && auth()->user()->id == $data->user_id)

            <a href="/scammer/{{ $data->slug }}/edit" class="btn btn-sm btn-pill btn-outline-secondary float-right">edit</a>

            @endif

            <hr class="my-2">

            <i class="fe fe-tag"></i> <a href="">{{$data->kategori->name}}</a>
            <br />
            <strong>Kronologi</strong> <br>

            @parsedown(e($data->body))
            <br><br>
            <h5>Identitas scammer</h5>
            <strong>Facebook</strong><br>
            <span class="text-muted">{{ $data->facebook }} </span><br><br>

            <strong>Line</strong><br>
            <span class="text-muted">{{ $data->line }} </span><br><br>
            <strong>ign toram</strong><br>
            <span class="text-muted">{{ $data->ign }} </span>
<br><br>
            <strong>kerugian</strong> <small class="text-muted">dalam bentuk spina</small> <br>
            <span class="text-success">{{ number_format($data->spina) }}s </span>

            <div class="my-5"></div>
            <div id="carousel-controls" class="carousel slide" data-ride="carousel">

            <strong>Screenshots bukti scam</strong><br />
              <div class="carousel-inner">

            @foreach ($data->picture as $img)
                <div class="carousel-item {{$loop->index == 0 ? 'active':''}}">
              <img src="{{$img->url}}" class="d-block w-100" data-holder-rendered="true">
                </div>

            @endforeach
                    <a class="carousel-control-prev" href="#carousel-controls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="text-primary">Prev</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-controls" role="button" data-slide="next">
                          <span class="text-primary">Next</span>
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                      </a>
               </div>
            </div>

            <div class="alert alert-info mt-5">
              Jika terdapat kesalahan atau data yang di tulis salah dan tidak benar, laporkan ke <a href="mailto:admin@toram-id.info">admin@toram-id.info</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection