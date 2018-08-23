@extends('layouts.tabler')

@section('title', 'Toram map ' . $data->name)
@section('description', $data->name . ' adalah peta yang berada di toram')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram {{ $data->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>
      <div class="col-md-8">

        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <dl> <!-- dl start -->
          @foreach ($data->monster as $mons)

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
             <dd>
              <b>Element:</b>  <span class="">{{$mons->element->name}}</span> <br>
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
             @endforeach
          </dl> <!-- // dl end -->
          </div>
        </div>

      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection