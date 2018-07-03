@extends('layouts.tabler')


@section('title',' Semua Notifikasi')
@section('description','Profile Notifikasi')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Notifikasi </h3>
          </div>
          @if(count($data) > 0)
      <div class="card-body p-1">
      @foreach ($data as $notify)
      <i class="fe fe-check"></i>  <b> {{ $notify->data['by'] }} </b>
        <a href="/forum/{{$notify->data['link']}}">
      {{ $notify->data['message'] }}
        </a> {{ $notify->created_at->diffForHumans() }}
      <br>
      @endforeach
      </div>
@else
      <div class="card-body">
      <b> belum ada notif :') </b>
      </div>
@endif
        </div>

          {{ $data->links() }}
      </div>
    </div>

  </div>
</div>
@endsection