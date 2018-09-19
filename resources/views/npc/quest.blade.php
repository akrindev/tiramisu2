@extends('layouts.tabler')

@section('title', 'Toram NPC: '. $npc->name)
@section('description', 'Toram npc: '.$npc->name.', list npc, quest, reward, npc picture and more')
@section('image', $npc->picture ?? to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Toram NPC: {{ $npc->name }}</h3>
    </div>

    <div class="row">
      <div class="col-md-8">
        <a href="/npc" class="mb-5 btn btn-outline-primary btn-pill">← back to npc</a>
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <div style="display:block;clear:both" class="mb-5">
              <img src="{{ $npc->picture }}" style="width:100px;height:100px;float:left" class="mr-3">
           <i class="fe fe-wind"></i> <a href="/npc/{{ $npc->id }}">{{ $npc->name }}</a><br>
              <small class="text-muted">( {{ $npc->map->name }} )</small>
           </div>
            <div style="clear:both"></div>
            <hr class="my-1">
            @foreach($npc->quest as $quest)
            <div class="mb-5">
             <b>Nama Quest:</b> {{ $quest->name }} <br>
              <b>Min. Level:</b> {{ $quest->level }} <br>
              @if (! is_null($quest->detail))
              <b>Detail:</b> <br>
              <p class="text-muted">{{ $quest->detail }}</p>
              @endif
              <b>Hadiah: </b> <span class="text-success"> {{ number_format($quest->exp) }}xp </span><br>
                  @foreach($quest->reward as $reward)
                  <img src="{{ $reward->drop->dropType->url }}" class="mr-2 rounded" style="width:18px;height:18px"> <a href="/item/{{ $reward->drop->id }}"> {{ $reward->drop->name }}</a> <br>
                  @endforeach
              <br>
              <b>Tujuan:</b> <br>
              @foreach($quest->tujuan as $tujuan)
                @if ($tujuan->defeat == 1)
                  <span class="text-danger">Bunuh <a href="/monster/{{ $tujuan->monster->id }}">{{ $tujuan->monster->name }}</a> </span> x{{ $tujuan->many }} <br>
                @endif
                @if ($tujuan->defeat == 2)
                  <span class="text-success">Kumpulkan <a href="/item/{{ $tujuan->drop->name }}">{{ $tujuan->drop->name }}</a></span> x{{ $tujuan->many }} <br>
                @endif
              @endforeach

            </div>
            <hr class="my-1">
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection