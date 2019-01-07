@extends('layouts.tabler')

@section('title', 'Toram '. $q )
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram {{ $q }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>
      <div class="col-md-8">
   @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')
          @if($drops->count() == 0 && $monsters->count() == 0 && $maps->count() == 0)
        <div class="card">
          <div class="card-body p-3" style="font-size:12px;font-weight:400">
            <b>Pencarian <u>{{ $q }}</u> tidak di temukan.</b> <br> Barangkali kamu mencari <a href="/leveling">Toram leveling finder ?</a>
            </div>
        </div>
          @endif

     @if($drops->count() > 0)
       @foreach($drops as $item)
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
              <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="max-width:21px;max-height:21px">
              <b class="h6"><a class="text-primary" href="/item/{{ $item->id }}">{{ $item->name }}</a></b>
           @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif

            <div class="row">
            @if(! is_null($item->picture))
              <div class="col-md-3">
              <img src="/img/ball-triangle.svg" data-src="/{{ $item->picture }}" class="rounded my-2 d-block lazyload" width="170px" height="170px"> </div>
            @endif

            @if(! is_null($item->note))
              <div class="col-md-9 my-1">
                @parsedown(nl2br(e($item->note)))
              </div>
            @endif
             </div>
            </div>
        </div>
       @endforeach
     @endif

        @if($monsters->count() > 0)
          @foreach ($monsters as $mons)
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">

          <dl> <!-- dl start -->
          <div class="">
           <dt class="mb-1">
           <b class="h6"> <a class="text-primary" href="/monster/{{ $mons->id }}">{{ $mons->name }} (Lv {{ $mons->level }}) </a>
          @switch($mons->type)
             @case(2)
               <img src="/img/f_boss.png" alt="mini boss" style="display:inline;max-width:120px;max-height:15px;">
               @break
             @case(3)
               <img src="/img/boss.png" class="boss" style="display:inline;max-width:120px;max-height:15px;">
          @endswitch
            </b>
           </dt>
            <dd>
            <div class="row">
               @if ($mons->picture != null)
               <div class="col-md-3"><img src="/{{ $mons->picture }}" alt="{{ $mons->name }}" class="rounded my-2 d-block" width="170px" height="170px"></div>
               @endif

               <div class="col-md-9">
               <b>Element:</b> <span> {{$mons->element->name}}</span> <br>
               <b>Peta: </b> <a href="/peta/{{ $mons->map->id }}">{{ $mons->map->name }}</a>
               </div>
            </div>
            </dd>
            </div>
          </dl> <!-- // dl end -->
          </div>
        </div>
          @endforeach
        @endif

       @if($maps->count() > 0)
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
          <div class="my-5">
  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
            </div>

          @if($maps->count() > 0)
            <div class="mt-5">
              <strong class="h4">Peta</strong> <br>
              @foreach($maps as $map)
             <i class="fe fe-github mr-2"></i> <a href="/peta/{{ $map->id }}">{{ $map->name }}</a> <br>
              @endforeach
            </div>
          @endif
          </div>
        </div>
       @endif

      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>

</div>
@endsection