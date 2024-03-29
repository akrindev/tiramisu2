@extends('layouts.tabler')

@section('title', $title)
@section('description','Forum toram online indonesia, diskusi tentang toram online, informasi menarik dan lainnya.')
@section('image',to_img())



@section('content')

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-md-8">

            <div id="cari-kan">
              {!! form_open('/forum/cari') !!}
              @csrf
              <div class="form-group">
                <div class="input-group">
                <input type="search" name="key" class="form-control" placeholder="cari di forum ..." required pattern="{2,}">    <span class="input-group-append">
                              <button class="btn btn-outline-primary" type="submit"><i class="fe fe-search"></i> Cari!</button>
                            </span>
                </div>
              </div>

              {!! form_close() !!}
            </div>

  @includeUnless(app()->isLocal(), 'inc.ads_article')

                <div class="card mb-3">
                  <div class="p-3">
                    <div class="block my-1">
                    <i class="fe fe-folder mr-2"></i> <a href="/forum"> Recent Discussions</a>
                    </div>
                    @foreach($categories as $kategori)
                    <div class="block my-1">
                    <i class="fe fe-folder mr-2"></i> <a href="/forum/kategori/{{ $kategori->slug }}"> {{ $kategori->name }}</a> <small class="text-muted ml-1"><i class="fe fe-message-circle"></i> {{ $kategori->forum->count() }}</small>
                    </div>
                    @endforeach
                  </div>
                </div>


                <a href="/forum/baru" class="d-block btn btn-outline-primary mb-3"> <i class="fe fe-edit-2"></i> Buat thread</a>

                <h3 class="text-muted">{{ $f_title ?? $title }} </h3>
                <div class="card">
                  <div class="p-0 m-0">
                    <table class="table card-table table-striped">
                    @forelse ($forums as $pos)

                      <tr>
                        <td width=85% class="px-2 py-2">
                            @if (to_img($pos->body, false))
                            <div class="d-block mb-1">
                                <img class="thumb" src="{{ to_img($pos->body) }}"/>
                            </div>
                            <style>
                                .thumb {
                                    max-height: 155px;
                                    width: 100%;
                                    object-fit: cover
                                }

                                @media (min-width: 576px) {
                                    .thumb {
                                        max-height: 205px
                                    }
                                }
                            </style>
                            @endif
                          <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="{{ $pos->user->getAvatar() }}" class="avatar float-left mr-4 lazyload">
                          {!! $pos->pinned == 1 ? '<i class="fa fa-paperclip"></i>':'' !!}
                          <a href="/forum/{{ $pos->slug }}"><b> {{ str_limit($pos->judul, 80) }} </b></a> <br>
                        <small class="text-muted">
                        @php $nama = explode(' ',$pos->user->name); @endphp

                        <i class="fe fe-user"></i> {{ $nama[0] }} &nbsp; <i class="fe fe-clock"></i> {{ $pos->created_at->diffForHumans() }}

                          &nbsp; <i class="fe fe-eye"></i> {{ $pos->views }} &nbsp; <i class="fe fe-message-square mr-1"></i> {{ $pos->comment->count() }}
                          <br />
     @foreach (explode(',',$pos->tags) as $tag)
@php
$color = ['success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];
@endphp

                        <small class="tag text-{{$i}} small">  {{ $tag }}</small>
      @endforeach
                          </small></td>
                      </tr>
                    @empty
                      <tr class="p-4">
                        <td>Belum ada diskusi! :'(</td>
                      </tr>
                 	@endforelse


                    </table>
                  </div>

                </div>

                    {{ $forums->links() }}

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

                @include('inc.menu')

              </div>
            </div>
          </div>
        </div>

@endsection
