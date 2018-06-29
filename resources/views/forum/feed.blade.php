@extends('layouts.tabler')

@section('content')

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
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
              <div class="col-md-8">

                <a href="/forum/baru" class="align-right btn btn-primary btn-pill mb-3">Tulis baru</a>

                <div class="card">
                  <div class="p-0 m-0">
                    <table class="table card-table table-striped">

                      @foreach ($data as $pos)
                      <tr>
                        <td width=85% class="px-2 py-2">
                          <img src="https://graph.facebook.com/{{ $pos->user->provider_id }}/picture?type=normal" class="avatar float-left mr-4">
                          {!! $pos->pinned == 1 ? '<i class="fa fa-paperclip"></i>':'' !!} <a href="/forum/{{ $pos->slug }}"><b> {{ str_limit($pos->judul,65) }} </b></a> <br>
                        <small class="text-muted">
   @php $nama = explode(' ',$pos->user->name); @endphp

                        {{ $nama[0] }} • {{ time_ago($pos->created_at) }} •
     @foreach (explode(',',$pos->tags) as $tag)
@php
$color = ['success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];
@endphp

                        <small class="tag text-{{$i}} small">  {{ $tag }}</small>
      @endforeach
                          </small></td>
                        <td class="text-right">
                          <b>{{ $pos->comment->count() }}</b><br>
                          <small class="text-muted">replies</small></td>
                      </tr>
                    @endforeach


                    </table>
                  </div>

                </div>

                    {{ $data->links() }}

              </div>
            </div>
          </div>
        </div>

@endsection