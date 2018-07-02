@extends('layouts.tabler')
@php
$res = 0;

if(count($threads) > 0):
	foreach ($threads as $t):
		$res += $t->comment->count();
	endforeach;
endif;
@endphp
@section('content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <div class="col-md-4 mb-5">
        <img src="https://graph.facebook.com/{{$profile->provider_id}}/picture?type=normal" class="img img-fluid mr-3 float-left">
        <b> {{ $profile->name }} </b>
        <span class="text-muted"> ({{ $profile->username }}) </span>
        <br><br>
        <span class="text-muted">  {{ $profile->gender }}</span>
        <p class="text-muted">
          {{ $profile->biodata }}
        </p>
        @auth
        <a href="/setting/profile" class="btn btn-link btn-sm">edit profile</a>
        @endauth
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
                <td> {{ $profile->count() }} </td>
                <td> {{ auth()->user()->comment->count() }} </td>
                <td> {{ $res }} </td>
                <td> {{ $profile->thread->sum('views') }}
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
          <td width=""> <a href="/forum/{{ $thread->slug }}">{{ str_limit($thread->body,40) }} </a><br>
            <small class="text-muted">{{ waktu($thread->created_at) }} • <i class="fe fe-eye"></i> {{ $thread->views }} <i class="fe fe-message-square"></i> {{ $thread->comment->count() }} </small></td>
          <td> <a href="/forum/{{$thread->slug}}/edit" class="text-primary">edit</a> | <a href="/forum/{{$thread->slug}}/del" class="text-danger" onClick="if(confirm('Yakin mau ngehapus?')) { return true; } else { return false;}">hapus</a>  </td>

        </tr>
@endforeach
      </table>
       </div>
      </div>
   @endif

  <div class="col-md-8">
    <div class="card">
      <h3 class="card-title"> Notifikasi </h3>
      <ul>
      @foreach ($profile->notifications as $notify)
        <li><b> {{ $notify->data['by'] }} </b>
        <a href="/forum/{{$notify->data['link']}}">
      {{ $notify->data['message'] }}
        </a> {{ $notify->created_at->diffForHumans() }}
      </li>
      @endforeach
      </ul>
    </div>
      </div>


    </div>

  </div>
</div>

@endsection