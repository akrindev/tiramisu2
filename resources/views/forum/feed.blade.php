@extends('layouts.tabler')

@section('title','Forum Toram Indonesia')
@section('description','Forum toram online indonesia, diskusi tentang toram online, curhat, kisah cinta di toram')
@section('image',to_img())

@section('content')

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-md-8">

                <a href="/forum/baru" class="float-right btn btn-primary btn-pill mb-3">Tulis baru</a>

            <div id="cari-kan">
              {!! form_open('/forum/cari') !!}
              @csrf
              <div class="form-group">
                <div class="input-group">
                <input type="search" name="key" class="form-control" placeholder="cari di forum ..." required pattern="{2,}">    <span class="input-group-append">
                              <button class="btn btn-outline-primary" type="button"><i class="fe fe-search"></i> Cari!</button>
                            </span>
                </div>
              </div>

              {!! form_close() !!}
            </div>


                <div class="card">
                  <div class="p-0 m-0">
                    <table class="table card-table table-striped">
				@if($data->count() > 0)
                    @foreach ($data as $pos)
                      <tr>
                        <td width=85% class="px-2 py-2">
                          <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="https://graph.facebook.com/{{ $pos->user->provider_id }}/picture?type=normal" class="avatar float-left mr-4 lazyload">
                          {!! $pos->pinned == 1 ? '<i class="fa fa-paperclip"></i>':'' !!}
                          <a href="/forum/{{ $pos->slug }}"><b> {{ str_limit($pos->judul,65) }} </b></a> <br>
                        <small class="text-muted">
   @php $nama = explode(' ',$pos->user->name); @endphp

                        By: {{ $nama[0] }} &nbsp; {{ time_ago($pos->created_at) }} <br />
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
                 @else
                      <tr class="p-4">
                        <td>Belum ada diskusi! :'(</td>
                      </tr>
                 @endif


                    </table>
                  </div>

                </div>

                    {{ $data->links() }}

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