@extends('layouts.tabler')

@if (count($data) == 1)
@section('title','Toram '.$data[0]->nama)

@section('description','Toram '.$data[0]->nama.' crysta, dan gem monster dan boss')
@section('image',url($data[0]->pics))
@else
@section('title','Toram list '.$data[0]->type)

@section('description','Toram database crysta, dan gem monster dan boss')

@section('image',to_img())
@endif


@section('content')
        <div class="my-3 my-md-5">
          <div class="container">
      @include('inc.cari')
            <div class="row row-cards">

              <!-- loop -->

  @if(count($data) > 0)
      @foreach($data as $pos)
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <a href="/equip/{{$pos->slug}}" class="mb-3">
                    <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="/{{ $pos->pics != '' ? $pos->pics: 'img/logo_toramonline.png' }}" class="rounded lazyload">
                  </a>
                  <div class="d-flex align-items-center">

                    <strong><a href="/equip/{{ $pos->slug }}">{{ $pos->nama }}</a></strong>&nbsp;&nbsp;

                    <div class="ml-auto text-danger">
           {{ $pos->type }}
                    </div>

                  </div>

                 <div>
                   <br />
                   <span class="text-muted">
                   {!! nl2br($pos->stats) !!}
                   </span>
                   <br />
                   <br />
                   <strong>Drop</strong>
                   <br />
                   -
                   <br />
                   <br />
                   <strong>Quest</strong>
                   <br />
                   <span class="text-muted">{{ $pos->quest }}</span>
                   <br />
                   <br />
                   <strong>Pakar padu: NPC</strong>
                   <br />
                   <span class="text-muted">
                   {{ $pos->blacksmith }}
                   </span>
                   <br /><br />
                   <strong>Pakar Padu: Player</strong>
                   <br />
                   {{ $pos->prod }}
                   <br /><br />
                   <b>proses material : </b>
                   {{ $pos->proc }}

                   <br/>
@auth
     @if(Auth::user()->role == 'admin')
                    <a href="/edit/{{ $pos->id }}/equip" class="btn btn-primary">edit</a>
     @endif
@endauth

                  </div>

                </div>
              </div>

      @endforeach
   @endif
              <!-- yeyy -->
            </div>
          </div>
</div>

@endsection