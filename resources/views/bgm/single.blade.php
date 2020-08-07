@extends('layouts.tabler')

@section('title',$bgm->title. ' - Download or play')
@section('description',$bgm->title.' Toram online background music list download or play online')
@section('image','https://ytimg.googleusercontent.com/vi/'.$bgm->video_id.'/sddefault.jpg')


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
        <div class="my-3">
          <a href="/bgm" class="btn btn-pill btn-outline-primary"><i class="fe fe-chevron-left"></i> Kembali ke daftar bgm</a>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> {{ $bgm->title }} </h3>
          </div>
          <div class="card-body p-3" style="font-size:14px;font-weight:400">

  @includeUnless(app()->isLocal(), 'inc.ads_mobile')

            <img src="https://ytimg.googleusercontent.com/vi/{{ $bgm->video_id }}/sddefault.jpg" class="img img-fluid">
            <div class="my-3">
        <br>
              <hr class="my-2">
              <div class="my-3">

<div class="my-3">
<h6>Download</h6>

<iframe style="width:100%;min-width:200px;max-width:350px;height:57px;border:0;overflow:hidden;" scrolling="no" src="//ytmp3.mobi/button-api/#{{ $bgm->video_id }}|mp3|1abc9c|fff"></iframe>
              </div>
                <br><br>
                <p>
                  <b> Lainnya: </b><br />
                  @foreach ($random as $rand)
                  <i class="fe fe-headphones"></i> <a href="/bgm/{{$rand->slug}}">{{ $rand->title }}</a><br />
                  @endforeach
                </p>
              </div>


            </div>
          </div>
        </div>
      </div>


     @if ($bgm->comments->count() > 0)
      <div class="col-12">
     	@foreach ($bgm->comments as $comment)

		<div class="card p-0">
          <div class="card-body p-3">
            <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="https://graph.facebook.com/{{$comment->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4 lazyload">
            <b><a href="/profile/{{$comment->user->provider_id }}">  {{ $comment->user->name }}</a> </b> <br>
            <small class="text-muted">{{ waktu($comment->created_at) }}</small>
            <hr class="my-2">
            <div class="body-text"
                 >@parsedown(e($comment->body))
            </div>
            @auth
            <div class="form-group">
              @if(auth()->user()->role == 'admin')
              <button class="btn btn-sm btn-pill btn-outline-danger">hapus</button>
              {!! form_open('/bgm/destroy',['id'=>'cid-'.$comment->id]) !!}
              @csrf
              @method("DELETE")
              <input type="hidden" name="id" value="{{$comment->id}}">
              {!! form_close() !!}
              @endif
            </div>

            @endauth
          </div>
      		</div>
        @endforeach
      </div>
     @endif

      <div class="col-12">
        @include('inc.bgm_comment')
      </div>
    </div>

  </div>
</div>
@endsection

@section('footer')
@guest
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  function dload()
  {
    swal('Login untuk mendownload','','warning');
  }
</script>
@endguest
@endsection