@extends('layouts.tabler')

@section('content')

@php
$commentss = $comments;
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
          @if ( session()->has('sukses'))
          <div class="card-alert alert alert-success">
            {{ session('sukses') }}
          </div>
          @endif
          <div class="card-status bg-{{ $data->color }}"></div>

          <div class="card-body text-wrap p-3">

     <img src="https://graph.facebook.com/{{$data->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4"> <b> {{ $data->user->name }} </b><br> <small class="text-muted"> {{ waktu($data->created_at) }} </small>
            <hr class="my-2">
            <div class="my-1">
              @foreach ($tags as $tag => $n)
              <a class="tag"> {{ $n }} </a>
              @endforeach
            </div>
            <div class="body-text">
            @parsedown(e($data->body))

              @auth


         @if (auth()->user()->role == 'admin')
            {!! form_open(url()->current().'/pin') !!}
            @csrf

            <input type="hidden" name="pinned" value="{{ $data->id }}">
              @if ($data->pinned == 0)

            <input type="hidden" name="pinthis" value="1">
            <button type="submit" class="btn btn-sm btn-pill btn-outline-success">Pin thread </button>
              @else
            <input type="hidden" name="pinthis" value="0">
            <button type="submit" class="btn btn-sm btn-pill btn-outline-danger">Unpin thread </button>
              @endif
            {!! form_close() !!}
         @endif

              @endauth
            </div>
          </div>
        </div>
   @php $i = 0; @endphp
@if (count($comments))
@foreach (collect($comments)->where('parent_id',null) as $comment)
   @php $i++; @endphp
		<div class="card p-0">
          <div class="card-body p-3">
            <img src="https://graph.facebook.com/{{$comment->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4">
            <b> {{ $comment->user->name }} </b> <br>
            <small class="text-muted">{{ waktu($comment->created_at) }}</small>
            <hr class="my-2">
            <div class="body-text">
            @parsedown(e($comment->body))
            </div>
            @auth
            <button class="btn btn-sm float-right btn-outline-primary" data-toggle="collapse" data-target="#comm-{{$i}}" role="button" aria-expanded="false" aria-controls="comm-{{$i}}">reply</button>

            @endauth
          </div>

          @foreach ($comment->getReply as $reply)
<hr class="my-1">
          <div class="p-2">
            <img src="https://graph.facebook.com/{{$reply->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4">
          <b> {{ $reply->user->name }} </b> <small class="text-muted"> • ({{ waktu($reply->created_at)}})</small><br>
            <div class="media-body">
            @parsedown(e($reply->body))
            </div>
          </div>
            @endforeach

          @auth

        @if (session()->has('sukses_reply-'.$comment->id))
          <div class="card-alert alert alert-success">
            {{ session('sukses_reply-'.$comment->id) }}
          </div>
        @endif
          <div class="collapse" id="comm-{{$i}}">
            {!! form_open(url()->current().'/c') !!}
            @csrf
            <div class="card-footer">
              <div class="form-group">
                <input type="hidden" name="id" value="{{$comment->id}}">
                <textarea class="form-control" data-provide="markdown" name="reply" required></textarea>

              </div>
              <button type="submit" class="btn btn-sm btn-primary">reply</button>
            </div>
            {!! form_close() !!}
          </div>
          @endauth
   		</div>

@endforeach
@endif



   		@include('inc.forum_comment')

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


@section('head')
@auth
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script>
  require(['mde']);
</script>
@endauth
@endsection