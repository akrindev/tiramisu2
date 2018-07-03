@extends('layouts.tabler')


@if (count($data) == 1)
@section('title','Toram '.$data[0]->nama)

@section('description','Toram '.$data[0]->nama.' berada pada '. $data[0]->map .' Monster, dan Boss monster')
@section('image',url($data[0]->pics))
@elseif (count($data) > 0)
@section('title','Toram list Monsters '.$data[0]->map)

@section('description','Toram database list monster pada '.$data[0]->map .', dan boss')

@section('image',to_img())
@else
@section('title','Toram list monster')
@section('description','Toram Monster list beserta boss')
@section('image',to_img())
@endif

@section('content')
        <div class="my-3 my-md-5">
          <div class="container">
    @include('inc.cari')
            <div class="row row-cards">
                     <!-- loop -->

  @if(count($data) > 0)
      @foreach ($data as $pos)

	<div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="h3 text-primary"><a href="/monster/{{ $pos->slug }}">{{ $pos->nama }}</a></div>
                      <br />

                    </div>
<div class="mb-5">
                          <img src="/{{ $pos->pics != '' ? $pos->pics: 'img/logo_toramonline.png' }}" class="rounded">
                      </div>

                    <div class="row">
                      <div class="col">

                        <h5 class="mb-1">Tameable</h5>
                        <div class="text-muted-dark">{{ $pos->kandang }}</div>
                      </div>
                      <div class="col">
                        <h5 class="mb-1">Level</h5>
                        <div class="text-muted-dark">{{ $pos->level }}</div>
                      </div>
                      <div class="col">
                        <h5 class="mb-1">Hp</h5>
                        <div class="text-muted-dark">{{ $pos->hp }}</div>
                      </div>
                      <div class="col">
                        <h5 class="mb-1">XP</h5>
                        <div class="text-muted-dark">{{ $pos->xp }}</div>
                      </div>
                      <div class="col">
                        <h5 class="mb-1">Element</h5>
                        <div class="text-muted-dark">{{ $pos->element }}</div>
                      </div>
                      <div class="col-6 mb-6">
                        <h5 class="mb-1">Type</h5>
                        <div class="text-muted-dark">{{ $pos->type }}</div>
                      </div>
                      <div class="col-6 mb-5">
                        <h5 class="mb-1">Peta</h5>
                        <div class="text-muted-dark"><a href="/peta/{{ $pos->mapslug }}">{{ $pos->map }}</a></div>
                      </div>


                      <div class="col-12">
                        <h5 class="mb-1">Drop item</h5>
                        <div class="text-muted-dark">{!! nl2br((new Parsedown)->text($pos->drop_items)) !!}</div>
                      </div>


                      <div class="col-12">
                        <h5 class="mb-1">Drop Perlengkapan</h5>
                        <div class="text-muted-dark">{!! nl2br((new Parsedown)->text($pos->drop_equip)) !!}</div>
                      </div>


                      <div class="col-12">
                        <h5 class="mb-1">Notes</h5>
                        <div class="text-muted-dark">{!! nl2br((new Parsedown)->text($pos->notes)) !!}</div>
                      </div>
                    </div>

                  <div>
@auth
        @if(Auth::user()->role == 'admin')
                    <a href="/edit/{{ $pos->id }}/mobs" class="btn btn-primary">edit</a>
        @endif
@endauth
                    </div>
                  </div>

                  </div>
                </div>

     @endforeach
<div class="col-12">
         {{ $data->appends(request()->except('page'))->links() }}
              </div>
   @else

              <div class="col-12">
              <h3>tidak ada</h3>
              </div>
   @endif

              </div>
    </div>

  </div>
@endsection