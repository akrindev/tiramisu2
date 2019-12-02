@extends('layouts.tabler')

@section('title', 'Toram drop map ' . $data->name)
@section('description', $data->name . ' adalah peta yang berada di toram')
@section('image', to_img())

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">{{ $data->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>

      <div class="col-md-8">
        @includeWhen(!app()->isLocal(), 'inc.ads_article')

        @if($data->npc->count() > 0)
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <strong class="h6">NPC</strong> <br>
             @foreach($data->npc as $npc)
           - <b>NPC:</b> <a href="/npc/npc-{{ $npc->id }}"> {{ $npc->name }} </a> <br />
          @endforeach
          </div>
        </div>
        @endif

      @foreach ($data->monster as $mons)
        @if(($loop->index + 1) % 5 == 0)
   			@includeWhen(env('APP_ENV') == 'production', 'inc.ads.infeed')
        @endif
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
          <dl> <!-- dl start -->
           <div class="mb-5">
           <dt class="mb-1">
           <b class="h6"> <a class="text-primary" href="/monster/{{$mons->id}}">{{ $mons->name }} (Lv {{$mons->level}}) </a>
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
               @if ($mons->picture != null)
               <div class="col-md-4"><img src="//toram-id.info/{{ $mons->picture }}" alt="{{ $mons->name }}" class="rounded my-2 d-block" width="150px" height="150px"></div>
               @endif
             <div class="col-md-8">
               <dd>
              <b>Unsur:</b>  <span class="">{{ ucfirst($mons->element->name) }}</span> <br>
               <b>Peta:</b> <a href="/peta/{{ $mons->map->id }}"> {{ $mons->map->name }}</a>
             </dd>
            @if($mons->drops->count() > 0)
             <b>Drop:</b><br>
             @foreach ($mons->drops as $drop)
             <a href="/item/{{$drop->id}}"> <img src="{{$drop->dropType->url}}" class="avatar avatar-sm"> {{$drop->name}} </a>
             @if ($drop->proses && $drop->sell)
             <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{ $drop->sell ?? '-' }}s)</small>
             @endif
             <br>
             @endforeach

            @endif
              </div>
             </div>
            </div>
          </dl> <!-- // dl end -->
          </div>
        </div>
      @endforeach

      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection