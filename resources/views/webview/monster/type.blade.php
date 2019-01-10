@extends('layouts.webview')

@section('title', 'Toram Monster Unsur ' . ucfirst($type))
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram Monster Type {{ ucfirst($type) }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('webview.cari')
      </div>
      <div class="col-md-8">

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

     @foreach ($data as $mons)
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <dl> <!-- dl start -->

           <div class="mb-5">
           <dt class="mb-1">
           <b class="h6"> <a class="text-primary" href="/webview/monster/{{$mons->id}}">{{ $mons->name }} (Lv {{$mons->level}}) </a>
          @switch($mons->type)
             @case(2)
               <img src="/img/f_boss.png" alt="mini boss" style="display:inline;max-width:120px;max-height:15px;">
               @break
             @case(3)
               <img src="/img/boss.png" class="boss" style="display:inline;max-width:120px;max-height:15px;">
          @endswitch
             </b>
           </dt>
         <div class="row">
            @if(! is_null($mons->picture))
             <div class="col-md-3">
              <img src="/img/ball-triangle.svg" data-src="/{{ $mons->picture }}" class="rounded my-2 d-block lazyload" width="170px" height="170px"></div>
            @endif
               <div class="col-md-9">
              <b>Element:</b>  <span class="">{{$mons->element->name}}</span>
            @if ($mons->type == 3 || $mons->type == 2)
               <br>
               <b>Leveling:</b> {{ $mons->level-3 }} <span class="text-muted">s/d</span> {{ $mons->level+3 }}
            @endif
               <br>
               <b>Peta:</b> <a href="/peta/{{ $mons->map->id }}"> {{ $mons->map->name }}</a>
            @if($mons->drops->count() > 0)
                 <div class="my-2"></div>
             <b>Drop:</b><br>
             @foreach ($mons->drops as $drop)
             <a href="/webview/item/{{$drop->id}}"> <img src="{{$drop->dropType->url}}" class="avatar avatar-sm"> {{$drop->name}} </a>
             @if ($drop->proses && $drop->sell)
             <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{ $drop->sell ?? '-' }}s)</small>
             @endif
             <br>
             @endforeach

            @endif
             </div></div>
            </div>
          </dl> <!-- // dl end -->
          </div>
        </div>
     @endforeach

        <div class="my-3">
        {{ $data->links() }}
        </div>

      </div>

      <div class="col-md-4">
      @include('inc.wv.menu_mons')
      </div>
    </div>
  </div>
</div>
@endsection