@extends('layouts.tabler')
@php
$res = 0;

if(count($threads) > 0):
	foreach ($threads as $t):
		$res += $t->comment->count();
	endforeach;
endif;
@endphp


@section('title','Profile '.$profile->name)
@section('description',$profile->biodata)
@section('image','https://graph.facebook.com/'.$profile->provider_id.'/picture?type=normal')

@section('content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <div class="col-md-4 mb-5">
        <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="https://graph.facebook.com/{{$profile->provider_id}}/picture?type=normal" class="img img-fluid mr-3 float-left lazyload">

        <b> {{ $profile->name }} </b>
        <span class="text-muted"> ({{ $profile->username }}) </span>
        <br><br>
      <b>Ign:</b>  <span class="text-muted">  {{ $profile->ign }} ~ {{ $profile->gender }}</span><br>
        {{ $profile->alamat }}
        <p class="text-muted">
          {{ $profile->biodata }}
        </p>
        <a href="/gallery/by/{{$profile->provider_id}}" class="btn btn-pill btn-sm btn-link">My Gallery</a>
      </div>

      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Aktifitas Forum</h4>
          </div>
          <table class="table card-table">
            <thead>
              <tr>
                <th> posts</th>
                <th> Menjawab </th>
                <th> Terjawab </th>
                <th> views </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> {{ $profile->thread->count() }} </td>
                <td> {{ $profile->comment->count() }} </td>
                <td> {{ $res }} </td>
                <td> {{ $profile->thread->sum('views') }}
              </tr>
            </tbody>
          </table>

<hr class="m-0 p-0">
           <div class="card-header mt-0">
            <h4 class="card-title">Aktifitas Gallery</h4>
          </div>
          <table class="table card-table">
            <thead>
              <tr>
                <th> images</th>
                <th> Menjawab </th>
                <th> views </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> {{ $profile->gallery->count() }} </td>
                <td> {{ $profile->gallerycomment->count() }} </td>
                <td> {{ $profile->gallery->sum('views') }}
              </tr>
            </tbody>
          </table>
        </div>
      </div>


   @if(count($threads) > 0)

      <div class="col-md-8">
	<div class="card">
      <div class="card-header">
        <h3 class="class-title">Latest threads</h3>
      </div>
      <table class="table card-table">
@foreach($threads as $thread)

        <tr>
          <td width=""> <a href="/forum/{{ $thread->slug }}">{{ str_limit($thread->judul,40) }} </a><br>
            <small class="text-muted">{{ waktu($thread->created_at) }} • <i class="fe fe-eye"></i> {{ $thread->views }} <i class="fe fe-message-square"></i> {{ $thread->comment->count() }} </small></td>
        </tr>
@endforeach
      </table>
       </div>
        {{ $threads->links() }}
      </div>
   @endif


    </div>

  </div>
</div>

@endsection